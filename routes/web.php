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
Route::get("/", function () {
    return view('home');
})->name('home');
Route::post("/contact/submit", 'App\Http\Controllers\ContactController@submit')->name('contact-form');
Route::get("/about", function () {
    return view('about');
})->name('about');

Route::get('/contact', function(){
    return view('contact');
})->name('contact');
Route::get("/contact/all", 'App\Http\Controllers\ContactController@allData')->name('contactData');
Route::get("/contact/all/{id}", 'App\Http\Controllers\ContactController@ShowOneMessage')->name('contactDataOne');
Route::get("/contact/{id}/update", 'App\Http\Controllers\ContactController@updateMessage')->name('updateMessage');
Route::post("/contact/{id}/update/done", 'App\Http\Controllers\ContactController@updateMessageSubmit')->name('contactUpdateSubmit');
Route::get("/contact/{id}/delete", 'App\Http\Controllers\ContactController@deleteMessage')->name('deleteMessage');
Route::post('/contact/getPost', 'App\Http\Controllers\ContactController@getPostByTitle')->name('getPost');