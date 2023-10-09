<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class FileService{
    public function saveFile($methodToInstall, $path){
        try{
            Excel::sstore($methodToInstall, $path);
        } catch(Throwable $error){
            Log::channel('slack')->critical('error', ['error' => $error]);
        }
    }
}