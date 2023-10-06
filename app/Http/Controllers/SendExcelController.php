<?php

namespace App\Http\Controllers;

use App\Jobs\SendExcel;

class SendExcelController extends Controller
{
    public function send()
    {
        $sendExcel = app(SendExcel::class);
        dispatch($sendExcel);
        return redirect()->back();
    }
}
