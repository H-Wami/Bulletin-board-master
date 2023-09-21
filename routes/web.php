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
        Route::get('/post/{keyword?}', 'PostsController@postView')->name('postView');
        // 新規投稿ページ表示
        Route::get('/post/input', 'PostsController@postInput')->name('postInput');
        // 新規投稿機能
        Route::post('/post/create', 'PostsController@postCreate')->name('postCreate');
        // 投稿詳細ページ表示
        Route::get('/post/detail/{id}', 'PostsController@postDetail')->name('postDetail');
        // 新規コメント機能
        Route::post('/comment/create', 'PostCommentsController@commentCreate')->name('commentCreate');
        // 投稿編集ページ表示
        Route::get('/post/edit/{id}', 'PostsController@postEdit')->name('postEdit');
        // 投稿編集機能
        Route::post('/post/update', 'PostsController@postUpdate')->name('postUpdate');
        // 投稿削除機能
        Route::get('/post/delete/{id}', 'PostsController@postDelete')->name('postDelete');
        // 投稿いいね作成機能
        // 投稿いいね削除機能
        // コメント編集ページ表示
        Route::get('/comment/edit/{id}', 'PostCommentsController@commentEdit')->name('commentEdit');
        // コメント編集機能
        Route::post('/comment/update', 'PostCommentsController@commentUpdate')->name('commentUpdate');
        // コメント削除機能
        Route::get('/comment/delete/{id}', 'PostCommentsController@commentDelete')->name('commentDelete');
        // コメントいいね作成機能
        
        // コメントいいね削除機能
    });

    // Admin\Postのまとまり
    Route::namespace('Admin\Post')->group(function () {
        // カテゴリー追加ページ表示
        Route::get('/category', 'PostsController@categoryView')->name('categoryView');
        // メインカテゴリー作成機能
        Route::post('/main_category/create', 'PostMainCategoriesController@mainCategoryCreate')->name('mainCategoryCreate');
        // メインカテゴリー削除機能
        Route::get('/main_category/delete/{id}', 'PostMainCategoriesController@mainCategoryDelete')->name('mainCategoryDelete');
        // サブカテゴリー作成機能
        Route::post('/sub_category/create', 'PostSubCategoriesController@subCategoryCreate')->name('subCategoryCreate');
        // サブカテゴリー削除機能
        Route::get('/sub_category/delete/{id}', 'PostSubCategoriesController@subCategoryDelete')->name('subCategoryDelete');
    });
});
