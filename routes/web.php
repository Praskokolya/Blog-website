<?php
use App\Http\Controllers\MyTestController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 

Route::middleware('set_locale')->group(function(){
    Route::get("/", 'App\Http\Controllers\ContactController@showHomePage')->name('home');
    Route::get("/home/post{id}", 'App\Http\Controllers\ContactController@addMessage')->name('postMessage');
    
    Route::post("/contact/submit", 'App\Http\Controllers\ContactController@submit')->name('contact-form');
    
    Route::get("/about", function () {
        return view('about');
    })->name('about');
    
    Route::get('/contact', function(){
        return view('contact');
    })->name('contact')->middleware('auth');
    Route::get("/message/all", 'App\Http\Controllers\ContactController@allData')->name('contactData');
    
    Route::get("/message/{id}", 'App\Http\Controllers\ContactController@ShowOneMessage')->name('contactDataOne');
    
    Route::get("/message/{id}/update", 'App\Http\Controllers\ContactController@updateMessage')->name('updateMessage');
    
    Route::put("/message/{id}/updated", 'App\Http\Controllers\ContactController@updateMessageSubmit')->name('contactUpdateSubmit');
    
    Route::delete("/message/{id}/delete", 'App\Http\Controllers\ContactController@deleteMessage')->name('deleteMessage');
    
    Route::post('/message/all', 'App\Http\Controllers\ContactController@getPostByTitle')->name('getPost');
    
    Route::get('/auth', function()
    {
        return view('RegComponents.signUp');
    })->name('authForm');
    
    Route::get('/auth/reg', function()
    {
        return view('RegComponents.register');
    })->name('regForm');
    
    Route::get('/auth/log', function()
    {
        return view('RegComponents.login');
    }
    )->name('login');
    
    Route::post('/auth/reg/done', 'App\Http\Controllers\authController@createAccount')->name('registerAccount');
    
    Route::post('/auth/log/done', 'App\Http\Controllers\authController@checkIfLog')->name('logAccount');
    
    Route::get('/auth/logout', 'App\Http\Controllers\authController@logout')->name('logoutAccount');
    
    Route::get('/change_language/{locale}', 'App\Http\Controllers\LanguageController@changeLanguage')->name('changeLanguage');

    Route::get('send/all/posts', 'App\Http\Controllers\SendExcelController@sendAllPosts')->name('sendExcel');
    
    Route::get('send/user/posts', 'App\Http\Controllers\SendExcelController@sendUserPosts')->name('sendUserExcel');

});