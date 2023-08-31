<?php

namespace App\Http\Controllers;
use App\Models\Table;
use Illuminate\Http\Request;

class myTestController extends Controller
{
    function myFunction(){
        echo '123';
    }

    function addToDatabase(){
        $data = [
            'name' => 'mykola'
        ];
    
        Table::create($data);
    
        return 'Данные добавлены в таблицу.';
    }
    function allFromDatabase(){
        $names = Table::all();
        dd($names->pluck('name'));
    }

    function main(){
        return view('main');
    }
}