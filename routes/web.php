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

// Auth\Loginのまとまり
Route::namespace('Auth\Login')->group(function(){
    // ログインページ表示
    Route::get('/login', 'LoginController@loginView')->name('login');
    // ログイン機能
    Route::post('/login/user', 'LoginController@login')->name('loginUser');

    // ログアウト機能
    Route::get('/logout', 'LoginController@logout')->name('logout');
});

// Auth\Registerのまとまり
Route::namespace('Auth\Register')->group(function (){
    // ユーザー登録ページ表示
    Route::get('/register', 'RegisterController@registerView')->name('registerView');
    // ユーザー登録機能
    Route::post('/register/user', 'RegisterController@register')->name('register');
});

// ユーザー登録確認ページ表示
Route::get('/added', 'Auth\Register\RegisterAddedController@added')->name('added');

// ログイン中のページ(ミドルウェアでログアウト中に表示させようとするとログインページに飛ぶ)
Route::group(['middleware' => ['auth']], function () {
    // User\Postのまとまり
    Route::namespace('User\Post')->group(function () {
        // 投稿一覧ページ表示
        Route::get('/post', 'PostsController@postView')->name('postView');
        // 新規投稿ページ表示
        Route::get('/post/input', 'PostsController@postInput')->name('postInput');
    });

    // Admin\Postのまとまり
    Route::namespace('Admin\Post')->group(function () {
        // カテゴリー追加ページ表示
        Route::get('/category', 'PostsController@categoryView')->name('categoryView');
    });
});
