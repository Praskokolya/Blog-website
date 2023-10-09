<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class TelegramService
{
    public function sendFileToTelegram($path)
    {
        try {
            $chatId = Config::get('telegram.chat_id');
            $token = Config::get('telegram.api_key');
            $url = Config::get('telsegram.api_url');
            $client = new Client();
            $client->request('POST', "$url$token/sendDocument", [
                'multipart' => [
                    [
                        'name' => 'chat_id',
                        'contents' => $chatId,
                    ],
                    [
                        'name' => 'document',
                        'contents' => Storage::get($path),
                        'filename' => 'messages.xlsx',
                    ],
                    [
                        'name' => 'caption',
                        'contents' => 'Here is your excel file',
                    ],
                ],

            ]);
        } catch (Throwable $error) {
            Log::channel('slack')->critical('error', ['error' => $error]);
        }
    }
}
