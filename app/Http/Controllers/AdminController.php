<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // 入力内容を確認し問題ない場合、管理者画面に遷移
    // エラーがある場合は、管理者ログイン画面にリダイレクト
    public function login(){
        return view('rootpage');
    }

    // 管理者アカウント作成画面へ遷移
    public function newAcountView(){
        return view('adminNewAcount');
    }

    // 管理者アカウント作成処理、成功後、管理者ログイン画面へ遷移
    public function makeAdminAcount(Request $request){
        $form = $request->only(['name','password']);
        // 管理者名・パスワードをハッシュ化
        $adminName = Hash::make( $form['name'] );
        $adminPassword = Hash::make( $form['password'] );
        // adominsテーブルに登録する処理
        $admin = new Admin();
        $admin->insert( $adminName, $adminPassword );
        return view('rootpage');
    }
}
