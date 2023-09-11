<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //初期ユーザーデータ作成
        DB::table('users')->insert([
            'username' => '早川和美',
            'email' => 'firstuser@icloud.com',
            'password' => bcrypt('wami0927'), // 暗号化処理
            'admin_role' => 10
        ]);
    }
}
