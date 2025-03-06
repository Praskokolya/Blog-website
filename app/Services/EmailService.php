<?php

namespace App\Services;

use Error;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class EmailService
{
    public function __construct()
    {
    }
    public function createUserCode()
    {
        try {
            $emailCode = rand(100000, 999999);
            Cache::put('email-code', $emailCode, now()->addDay());
        } catch (\Exception $error) {
            log::error($error);
        }
    }
    public function SaveUserCode($code)
    {
        try {
            Cache::put('user-code', $code, now()->addDay());
        } catch (\Exception $error) {
            Log::error($error);
        }
    }
    public function checkCodes()
    {
        if (Cache::get('user-code') == Cache::get('email-code')) {
            return true;
        };
        return false;
    }
}
