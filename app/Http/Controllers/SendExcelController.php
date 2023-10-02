<?php
namespace App\Http\Controllers;
use Exception;
use App\Jobs\SendExcelJob;
class SendExcelController extends Controller
{
    public function send(){
        try{
            SendExcelJob::dispatch();
            return redirect()->back();
        }catch(Exception $e){
            dd('1232');
        }
    }
}
