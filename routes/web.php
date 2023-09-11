<?php

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

// welcomeページ表示
// Route::get('/', function () {
//     return view('welcome');
// });

// ログアウト中のページ
Route::group(['middleware' => ['guest']], function(){
    // Auth\Loginのまとまり
    Route::namespace('Auth\Login')->group(function(){
        // ログインページ表示
        Route::get('/login', 'LoginController@loginView')->name('loginView');

        // ログイン機能
        Route::post('/login/user', 'LoginController@login')->name('login');
    });

    // Auth\Registerのまとまり
    Route::namespace('Auth\Register')->group(function (){
        // ユーザー登録ページ表示
        Route::get('/register', 'Auth\Register\RegisterController@registerView')->name('registerView');
    });
});


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
