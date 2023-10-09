<?php

namespace App\Http\Controllers;
use App\Jobs\SendExcel;
class SendExcelController extends Controller
{
    public function send()
    {
        SendExcel::dispatch();
        return redirect()->back();
    }
}
