<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    // ログイン画面表示
    public function loginView()
    {
        return view("auth.login");
    }

    // ログイン機能
    public function login(Request $request)
    {
        if ($request ->isMethod('post')){ // POST送信されたら
            $user = $request -> only('email', 'password'); // email,passwordのみ取得
            if (Auth::attempt($user)) { // ログインできているか判定
                return redirect('/post'); // 投稿一覧ページ読み込む　
            }
        }
        return redirect('/login'); // 一致していなかったら再読み込み
    }

    // ログアウト機能
    public function logout(Request $request)
    {
        Auth::logout(); // ログアウト実行
        return redirect('/login'); // ログインページ読み込み
    }

}
