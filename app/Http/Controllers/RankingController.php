<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{
    public function index(){
        $userinfo = Auth::user();
        $username = $userinfo['name'];
        //降順に表示
        $user=array(User::orderBy('u_point','desc')->get());
        //4位以降取得
        $user_4=array_slice($user,3);






        return view('ranking',compact('user','username','user_4'));


    }
}
