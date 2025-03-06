<?php

namespace App\Http\Controllers;

use App\Jobs\SendUserExcel;
use App\Jobs\SendExcel;
use Illuminate\Support\Facades\Auth;

class SendExcelController extends Controller
{
    
    public function sendAllPosts()
    {
        SendExcel::dispatch();
        return redirect()->back();
    }
    public function sendUserPosts()
    {
        $id = Auth::id();
        SendUserExcel::dispatch(Auth::user()->nickname, $id);
        return redirect()->back();
    }
}
