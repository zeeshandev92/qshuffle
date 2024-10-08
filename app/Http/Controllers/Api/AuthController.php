<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OTP;
use App\Models\User;
use App\Traits\AuthTrait;
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
    use AuthTrait;

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



            $user = User::where('mobile_no', $request->mobile_no)->first();

            if (is_null($user->mobile_verified_at)) {
                throw new  ErrorException('The mobile number is not verified.', 400);
            }

            $user->update(
                [
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

            $otp = $this->generateOTP($request->mobile_no);

            DB::commit();
            return $this->apiResponse(result: ['otp' => $otp], message: 'OTP sent successfully and validated for 5 minutes.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->apiException($th->getMessage());
        }
    }

    // Verify OTP
    public function verifyOTP(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'mobile_no' => 'required',
                'otp' => 'required'
            ]);

            $otpRecord = $this->otpVerification($request->mobile_no, $request->otp);

            if (!$otpRecord) {
                return $this->apiException('Invalid or expired OTP.', 400);
            }

            User::where('mobile_no', $request->mobile_no)->update([
                'mobile_verified_at' => now(),
            ]);

            DB::commit();
            return $this->apiResponse(message: 'User verified successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->apiException($th->getMessage());
        }
    }

    public function forgotPassword(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'mobile_no' => 'required|exists:users',
            ]);

            $otp = $this->generateOTP($request->mobile_no);
            User::where('mobile_no', $request->mobile_no)->update([
                'mobile_verified_at' => null,
            ]);

            DB::commit();
            return $this->apiResponse(result: ['otp' => $otp], message: 'OTP sent successfully and validated for 5 minutes.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->apiException($th->getMessage());
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'mobile_no' => 'required|exists:users',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::where('mobile_no', $request->mobile_no)->first();

            if (is_null($user->mobile_verified_at)) {
                throw new  ErrorException('The mobile number is not verified.', 400);
            }

            $user->update([
                'password' => $request->password,
            ]);

            DB::commit();
            return $this->apiResponse(message: 'Password reset successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->apiException($th->getMessage());
        }
    }
}
