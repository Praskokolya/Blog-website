<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\ContactsExport;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SendExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Excel::store(new ContactsExport, 'public/excel-files/messages.xlsx');
        $token = env('TELEGRAM_BOT_TOKEN'); 
        $client = new Client();
        $client->request('POST', "https://api.telegram.org/bot$token/sendDocument", [
            'multipart' => [
                [
                    'name' => 'chat_id',
                    'contents' => 5025835246,
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
        Storage::delete('public/excel-files/messages.xlsx');
    }
}
