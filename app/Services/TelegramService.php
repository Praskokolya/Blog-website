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
    /**
     * @param string $path
     * @return void
     */
    public function sendFileToTelegram($prefixToPath)
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
                        'contents' => Storage::get($prefixToPath.'messages.xlsx'),
                        'filename' => $prefixToPath.'messages.xlsx',
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
