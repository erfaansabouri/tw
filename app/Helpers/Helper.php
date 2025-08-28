<?php

namespace App\Helpers;

use App\Models\VerificationCode;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Helper
{
    public static function standardPhone($phone)
    {
        if (strlen($phone) === 10 and substr($phone, 0, 1) != 0) {
            $phone = Str::start($phone, 0);
        }

        return $phone;
    }

    public static function getSmsCooldown($phone)
    {
        if (config('app.env') != 'production') {
            return false;
        }
        $verificationCode = VerificationCode::query()
            ->where('phone', $phone)
            ->latest()
            ->first();

        if ($verificationCode && Carbon::parse($verificationCode->created_at)->diffInSeconds(now()) < 60) {
            return 60 - Carbon::parse($verificationCode->created_at)->diffInSeconds(now());
        }

        return false;
    }

    public static function implodedElements(array $array){
        return implode(',', array_values($array));
    }
}
