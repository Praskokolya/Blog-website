<?php

namespace App\Jobs;

use App\Services\SendExcelService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\ContactsExport;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SendExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $contactsExport;

    protected $sendExcelService;
    /**
     * SendExcel constructor
     *
     * @param ContactsExport     $contactsExport
     * @param SendExcelService   $sendExcelService
     */
    public function __construct(ContactsExport $contactsExport, SendExcelService $sendExcelService)
    {
        $this->contactsExport = $contactsExport;
        $this->sendExcelService = $sendExcelService;
    }

    /** Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Excel::store($this->contactsExport, 'public/excel-files/messages.xlsx');
            $this->sendExcelService->sendFileBot();
            Storage::delete('public/excel-files/messages.xlsx');
        } catch (Exception $error) {
            Log::channel('slack')->error('error', [
                'error' => $error
            ]);
        }
    }
}
