<?php

use App\Http\Controllers\ContactController;
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

Route::middleware('set_locale')->group(function () {
    Route::get("/", 'App\Http\Controllers\ContactController@showHomePage')->name('home');
    Route::get("/home/post{id}", 'App\Http\Controllers\ContactController@addMessage')->name('postMessage');

    Route::post("/post/create", 'App\Http\Controllers\ContactController@submit')->name('contact-form');

    Route::get("/about", function () {
        return view('about');
    })->name('about');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact')->middleware('auth');
    Route::get("posts", 'App\Http\Controllers\ContactController@all')->name('contactData')->middleware('auth');

    Route::get("post/{id}", 'App\Http\Controllers\ContactController@message')->name('contactDataOne');
    Route::get("post//twitter/{id}", 'App\Http\Controllers\TwitterController@createTwitterPost')->name('make-post-twitter');

    Route::get("post/{id}/update/form", 'App\Http\Controllers\ContactController@update')->name('update');

    Route::put("post/{id}", 'App\Http\Controllers\ContactController@updateSubmit')->name('contactUpdateSubmit');

    Route::delete("post/{id}", 'App\Http\Controllers\ContactController@delete')->name('delete');

    Route::post('post/sort', 'App\Http\Controllers\ContactController@getPost')->name('getPost');

    Route::get('auth', function () {
        return view('RegComponents.signUp');
    })->name('authForm');

    Route::get('auth/reg', function () {
        return view('RegComponents.register');
    })->name('regForm');

    Route::get('auth/log/twitter', 'App\Http\Controllers\TwitterController@logWithTwitter')->name("sign-with-twitter");
    Route::get('auth/log/twitter/callback', 'App\Http\Controllers\TwitterController@handleTwitterCallback');

    Route::get('auth/log/google', 'App\Http\Controllers\GoogleController@logWithGoogle')->name('sign-with-google');
    Route::get('auth/log/google/callback', 'App\Http\Controllers\GoogleController@handleGoogleCallback');

    Route::get('auth/log', function () {
        return view('RegComponents.login');
    })->name('login');

    Route::post('auth/reg/done', 'App\Http\Controllers\authController@prepareData')->name('registerAccount');
    Route::get('auth/reg/verificate-email', function () {
        return view('VerificateCode');
    })->name('VerificateAccount');
    Route::post('auth/reg/check-code', 'App\Http\Controllers\authController@createAccount')->name('checkEmailCode');
    Route::post('auth/log/done', 'App\Http\Controllers\authController@checkIfLog')->name('logAccount');

    Route::get('auth/logout', 'App\Http\Controllers\authController@logout')->name('logoutAccount');

    Route::get('change_language/{locale}', 'App\Http\Controllers\LanguageController@changeLanguage')->name('changeLanguage');

    Route::get('send/posts', 'App\Http\Controllers\SendExcelController@sendAllPosts')->name('sendExcel');

    Route::get('send/user/posts', 'App\Http\Controllers\SendExcelController@sendUserPosts')->name('sendUserExcel');

    Route::get('response/form{id}', 'App\Http\Controllers\ContactController@responseForm')->name('responseForm');

    Route::get('response/create', 'App\Http\Controllers\ContactController@responseCreate')->name('responseCreate');

    Route::get('user/profile',  'App\Http\Controllers\userController@showUserProfile')->name('userProfile');

    Route::post('user/profile', 'App\Http\Controllers\userController@setUserData')->name('setData');

    Route::delete('user/profile', 'App\Http\Controllers\UserController@deleteImage')->name('deleteImage');

    Route::get('team', function () {
        return view('footer.team');
    })->name('team');

    Route::get('feed', 'App\Http\Controllers\FeedController@getAllUsers')->name('feed');

    Route::get('user/{id}', 'App\Http\Controllers\FeedController@getOneUser')->name('OneUser');
    Route::POST('create-response', 'App\Http\Controllers\ResponseController@createResponse')->name("create-response");
});
