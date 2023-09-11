<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\User;

class RegisterController extends Controller
{

    // ユーザー登録ページ表示
    public function registerView()
    {
        return view('auth.register');
    }


}
