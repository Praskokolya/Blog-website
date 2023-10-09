<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class FileService{
    /**
     * @param mixed $methodToInstall
     * @param string $path
     * @return void
     * instal file, first parametr its way how you will install this file, and second its just prefix to path,
     * in my case its excel
     */
    public function saveFile($methodToInstall, $prefixToPath){
        try{
            Excel::store($methodToInstall, $prefixToPath . 'messages.xlsx');
        } catch(Throwable $error){
            Log::channel('slack')->critical('error', ['error' => $error]);
        }
    }
}