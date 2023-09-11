<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // ログイン画面表示
    public function loginView()
    {
        return view("auth.login");
    }

    // ログイン機能
    public function login(Request $request)
    {
        if ($request ->isMethod('post')){
            $user = $request -> only('email', 'password');
            if (Auth::attempt($user)) {
                return redirect('/top');
            }
        }
        return redirect('/login'); // 一致していなかったら再読み込み
    }

}
