<?php

namespace App\Traits;

use App\Models\OTP;
use Carbon\Carbon;

trait AuthTrait
{

    public function generateOTP($mobileNo)
    {
        $otp = rand(1000, 9999);

        // $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        // $twilio->messages->create(
        //     $request->mobile, // The user's phone number
        //     [
        //         'from' => env('TWILIO_PHONE_NUMBER'), // Your Twilio number
        //         'body' => "Your OTP is $otp"
        //     ]
        // );
        OTP::create([
            'mobile_no' => $mobileNo,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(5)
        ]);

        return $otp;
    }


    public function otpVerification($mobileNo, $otp)
    {
        $otpRecord = Otp::where('mobile_no', $mobileNo)
            ->where('otp', $otp)
            ->where('expires_at', '>=', Carbon::now())
            ->first();

        return $otpRecord;
    }
}
