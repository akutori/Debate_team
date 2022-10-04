<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index(){
        $userinfo = Auth::user();
        $username = $userinfo['name'];

        return view('mypage',compact('username'));
    }
}
