<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OTP;
use App\Models\User;
use Carbon\Carbon;
use ErrorException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        try {
            $request->validate([
                'mobile_no' => 'required',
                'password' => 'required',
            ]);

            $credentials = $request->only('mobile_no', 'password');
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $user->token = $user->createToken("API TOKEN")->plainTextToken;
            }
            return $this->apiResponse(result: $user, message: 'User login successfully');
        } catch (\Throwable $th) {
            return $this->apiException($th->getMessage());
        }
    }

    public function register(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'mobile_no' => 'required',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'gender' => 'required',
                'relation_id' => 'required',
            ]);



            $user = User::where('mobile_no', $request->mobile_no)
                ->whereNotNull('mobile_verified_at')->first();

            if (is_null($user)) {
                throw new  ErrorException('The mobile number is not verified.', 400);
            }

            $user->update(
                [
                    'name' => $request->name,
                    'password' => $request->password,
                    'gender' => $request->gender,
                ]
            );

            $user->relations()->attach($request->relation_id);

            DB::commit();
            return $this->apiResponse(result: $user, message: 'User registered successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->apiException($th->getMessage());
        }
    }

    public function sendOTP(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'mobile_no' => 'required',
                'name' => 'required',
            ]);

            $otp = rand(1000, 9999);


            User::firstOrCreate(
                [
                    'mobile_no' => $request->mobile_no,
                ],
                [
                    'name' => $request->name,
                    'type' => 'app',
                    'password' => Str::random(12),
                ]
            );

            // $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

            // $twilio->messages->create(
            //     $request->mobile, // The user's phone number
            //     [
            //         'from' => env('TWILIO_PHONE_NUMBER'), // Your Twilio number
            //         'body' => "Your OTP is $otp"
            //     ]
            // );

            // Save OTP to database with expiration time (e.g., 5 minutes)
            OTP::create([
                'mobile_no' => $request->mobile_no,
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(5)
            ]);
            DB::commit();
            return $this->apiResponse(result: ['otp' => $otp], message: 'OTP sent successfully and validated for 5 minutes.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->apiException($th->getMessage());
        }
    }

    // Verify OTP
    public function verifyOtp(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'mobile_no' => 'required',
                'otp' => 'required'
            ]);

            $otpRecord = Otp::where('mobile_no', $request->mobile_no)
                ->where('otp', $request->otp)
                ->where('expires_at', '>=', Carbon::now())
                ->first();

            if (!$otpRecord) {
                return $this->apiException('Invalid or expired OTP.', 400);
            }

            User::where('mobile_no', $request->mobile_no)->update([
                'mobile_verified_at' => now(),
            ]);

            DB::commit();
            return $this->apiResponse(message: 'OTP verified successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->apiException($th->getMessage());
        }
    }
}
