<?php

namespace App\Http\Controllers;

use App\Jobs\SendExcel;
use App\Jobs\SendUserExcel;
use Illuminate\Support\Facades\Auth;
use App\Exports\UserPostsExport;
use App\Models\Contact;
use Maatwebsite\Excel\Facades\Excel;

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
