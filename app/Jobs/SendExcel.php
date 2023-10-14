<?php

namespace App\Jobs;

use App\Exports\AllPostsExport;
use App\Services\FileService;
use App\Services\TelegramService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\ContactsExport;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $contactsExport;

    protected $sendExcelService;

    protected $fileService;
    /**
     * SendExcel constructor
     *
     * @param ContactsExport $contactsExport
     * @param TelegramService $sendExcelService
     * @param FileService $fileService
     */

    /** Execute the job.
     *
     * @return void
     */
    /**
     * const PATH
     * just path to excel files folder
     */
    const PATH = "public/excel-files";
    /**
     * @param $AllPostsExport
     * @param TelegramService $sendExcelService
     * @param FileService $fileService
     * @return void
     */
    public function handle(AllPostsExport $contactsExport, TelegramService $sendExcelService, FileService $fileService)
    {
        $date = now()->format('Y-m-d');
        $prefix = self::PATH . '/' . $date;

        $this->contactsExport = $contactsExport;
        $this->sendExcelService = $sendExcelService;
        $this->fileService = $fileService;

        try {
            $this->fileService
                ->saveAllPosts($this->contactsExport, $prefix);
            $this->sendExcelService
                ->sendFileToTelegram($prefix);
        } catch (Throwable $error) {
            Log::channel('slack')->critical('error', ['error' => $error]);
        }
    }
}
