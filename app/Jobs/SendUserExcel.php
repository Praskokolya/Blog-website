<?php

namespace App\Jobs;

use App\Exports\UserPostsExport;
use App\Services\FileService;
use App\Services\TelegramService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendUserExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $fileService;
    public $userPostsExport;
    public $currentUserNickName;
    public $telegramService;
    public $id;
    public function __construct($currentUserNickname, $id)
    {
        $this->currentUserNickName = $currentUserNickname;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    /**
     * const PATH
     */
    const PATH = "public/excel-files";
    /**
     * @param FileService $fileService
     * @param UserPostsExport $userPostsExport
     * @param TelegramService $sendExcelService
     * @return void
     */
    public function handle(FileService $fileService, UserPostsExport $userPostsExport, TelegramService $sendExcelService)
    {
        try {
            $this->telegramService = $sendExcelService;
            $this->fileService = $fileService;
            $this->userPostsExport = $userPostsExport;
            $date = now()->format('Y-m-d');

            $prefix = self::PATH . '/' . $date . '_' . $this->currentUserNickName . '_';

            $this->fileService->saveUserPosts($this->id, $prefix);
            $this->telegramService->sendFileToTelegram($prefix);
        } catch (Throwable $error) {
            Log::channel('slack')->critical('error', ['error' => $error]);
        }
    }
}
