<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectPath()
    {
        return '/index';
    }

    // ユーザー登録ページ表示
    public function registerView(Request $request)
    {
        return view('auth.register');
    }
}
