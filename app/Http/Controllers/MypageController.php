<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index(){
        $userinfo = Auth::user();
        $username = $userinfo['name'];
        // mypageでポイントを出すための処理
        $userpoint = $userinfo['u_point'];
        // ポイントが登録されていない場合0を代入する
        if($userpoint == ""){
            $userpoint = 0;
        }
        return view('mypage',compact('username', 'userpoint'));
    }
}
