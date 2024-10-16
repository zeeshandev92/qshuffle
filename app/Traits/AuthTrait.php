<?php

namespace App\Traits;

use App\Models\OTP;
use Carbon\Carbon;
use Twilio\Rest\Client;

trait AuthTrait
{

    public function generateOTP($mobileNo)
    {
        // $otp = rand(1000, 9999);

        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        $verification = $twilio->verify->v2->services(env('TWILIO_API_SERVICE_ID'))
            ->verifications
            ->create($mobileNo, "sms");

        // OTP::create([
        //     'mobile_no' => $mobileNo,
        //     'otp' => $otp,
        //     'expires_at' => Carbon::now()->addMinutes(5)
        // ]);

        return $verification->status;
    }


    public function otpVerification($mobileNo, $otp)
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        $verification_check = $twilio->verify->v2
            ->services("VAcd8983ab39ff02bd6c77127a2eb0d2e1")
            ->verificationChecks->create([
                "to" => $mobileNo,
                "code" => $otp,
            ]);

        return $verification_check->status;
    }
}
