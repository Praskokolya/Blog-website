<?php

namespace App\Http\Controllers;

use App\Exports\UserPostsExport;
use App\Jobs\SendExcel;
use App\Jobs\SendUserExcel;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
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
