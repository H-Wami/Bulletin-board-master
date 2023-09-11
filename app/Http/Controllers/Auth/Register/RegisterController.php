<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\User;
use App\Http\Requests\RegisterFormRequest; // フォームリクエスト使用
use DB;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    // ユーザー登録ページ表示
    public function registerView()
    {
        return view('auth.register');
    }

    // ユーザー登録機能
    public function register(RegisterFormRequest $request) // フォームリクエスト使用・バリデーションメッセージ
    {
        DB::beginTransaction(); // トランザクション(一連の処理のまとめ)開始
        try{ // 例外が起こる可能性のある処理
            if ($request->isMethod('post')){ // POST送信されたら

                $username = $request->input('username');
                $email = $request->input('email');
                $password = $request->input('password'); // それぞれの値を格納

                User::create([ // ユーザー登録実行
                    'username' => $username,
                    'email' => $email,
                    'password' => bcrypt($password),
                ]);

                DB::commit();// トランザクションで実行したSQLをすべて確定する
                return redirect()->route('added'); // ユーザー登録確認ページ表示
            }

        } catch (\Exception $e) { // 例外が起こった時の処理
            DB::rollback(); // トランザクションで実行したSQLをすべて破棄する
            return redirect()->route('loginView'); //ユーザー登録ページ再読み込み
        }

    }


}
