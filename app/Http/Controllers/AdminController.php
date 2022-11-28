<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Ng;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // 入力内容を確認し問題ない場合、管理者画面に遷移
    // エラーがある場合は、管理者ログイン画面にリダイレクト
    public function login(Request $request){
        // 入力された内容を受け取る
        $form = $request->only(['name','password']);
        // 値を入れ直す
        $adminName =  $form['name'];
        $adminPassword = $form['password'] ;

        // adominsテーブルに登録されているか検索
        $admin = new Admin();
        $adminAcount = $admin->adminCheck($adminName, $adminPassword);
        if( !($adminAcount == null) ){
            $adminName = $form['name'];
            return view('rootpage',compact('adminName'));
        } else {
            return view('adminLogin');
        }
    }

    // 管理者アカウント作成画面へ遷移
    public function newAcountView(){
        return view('adminNewAcount');
    }

    // 管理者アカウント作成処理、成功後、管理者ログイン画面へ遷移
    public function makeAdminAcount(Request $request){
        // 入力された内容を受け取る
        $form = $request->only(['name','password']);
        // パスワードをハッシュ化
        $adminName = $form['name'];
        $adminPassword = Hash::make( $form['password'] );
        // adominsテーブルに登録する処理
        $admin = new Admin();
        $admin->insert( $adminName, $adminPassword );
        return view('rootpage',compact('adminName'));
    }

    // 管理者画面からNGword編集画面へ遷移
    public function ngwordView(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        // モデル「NG」のインスタンスを生成
        $ng = new Ng();

        // モデル「Ng」のngListメソッドを呼び出す
        //　戻り値：ngLists に代入
        $list = $ng->ngList();

        // ngword.blade.php　を表示
        //　compact で ngLists を渡す
        return view('ngword', compact('list'));

    }

    // Ngword編集画面から登録のみする
    //　遷移先はNgword編集画面
    public function ngwordInsert(Request $request){
        // 入力された内容を受け取る
        $n_words = $request->only('ngword');

        // モデル「NG」のインスタンスを生成
        $ng = new Ng;
        //$ng->timestamps = false;

        // Ngテーブルに登録する処理
        $ng->create([
            'n_words'=>$request->input('ngword'),
        ]);
        //$ng->ngwordInsert($n_words);

        // Ngwrod編集画面へ遷移
        $list = $ng->ngList();
        return view('ngword',compact('list'));
    }
}
