<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SendExcelService
{
    public function sendFileBot()
    {
        try {
            $chatId = Config::get('telegram.chat_id');
            $token = Config::get('telegram.api_key');
            $url = Config::get('telegram.api_url');
            $client = new Client();
            $client->request('POST', "$url$token/sendDocument", [
                'multipart' => [
                    [
                        'name' => 'chat_id',
                        'contents' => $chatId,
                    ],
                    [
                        'name' => 'document',
                        'contents' => Storage::get('public/excel-files/messages.xlsx'),
                        'filename' => 'messages.xlsx',
                    ],
                    [
                        'name' => 'caption',
                        'contents' => 'Here is your excel file',
                    ],
                ],

            ]);
        } catch (Exception $error) {
            Log::channel('slack')->error('error', [
                'error' => $error
            ]);
        }
    }
}
