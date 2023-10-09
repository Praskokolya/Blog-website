<?php

namespace App\Jobs;

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
    public function __construct(ContactsExport $contactsExport, TelegramService $sendExcelService, FileService $fileService )
    {
        $this->contactsExport = $contactsExport;
        $this->sendExcelService = $sendExcelService;
        $this->fileService = $fileService;
    }

    /** Execute the job.
     *
     * @return void
     */
    const PATH = 'public/excel-files/messages.xlsx';
    public function handle()
    {
        try {
            $this->fileService->saveFile($this->contactsExport, self::PATH);
            $this->sendExcelService->sendFileToTelegram(self::PATH);
        } catch (Throwable $error) {
            Log::channel('slack')->critical('error', ['error' => $error]);
        }
    }
}
