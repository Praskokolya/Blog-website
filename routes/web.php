<?php
use App\Http\Controllers\MyTestController;
use Illuminate\Support\Facades\Route;
Auth::routes();
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
    Route::get("/contact/all", 'App\Http\Controllers\ContactController@allData')->name('contactData');
    
    Route::get("/contact/all/{id}", 'App\Http\Controllers\ContactController@ShowOneMessage')->name('contactDataOne');
    
    Route::get("/contact/{id}/update", 'App\Http\Controllers\ContactController@updateMessage')->name('updateMessage');
    
    Route::post("/contact/{id}/update/done", 'App\Http\Controllers\ContactController@updateMessageSubmit')->name('contactUpdateSubmit');
    
    Route::get("/contact/{id}/delete", 'App\Http\Controllers\ContactController@deleteMessage')->name('deleteMessage');
    
    Route::post('/contact/getPost', 'App\Http\Controllers\ContactController@getPostByTitle')->name('getPost');
    
    Route::get('/auth', 'App\Http\Controllers\authController@signUpForm')->name('authForm');
    
    Route::get('/auth/reg', 'App\Http\Controllers\authController@registration')->name('regForm');
    
    Route::get('/auth/log', 'App\Http\Controllers\authController@login')->name('login');
    
    Route::get('/auth/reg/done', 'App\Http\Controllers\authController@createAccount')->name('registerAccount');
    
    Route::post('/auth/log/done', 'App\Http\Controllers\authController@checkIfLog')->name('logAccount');
    
    Route::get('/auth/logout', 'App\Http\Controllers\authController@logout')->name('logoutAccount');
    
    Route::get('/change_language/{locale}', 'App\Http\Controllers\LanguageController@changeLanguage')->name('changeLanguage');
});