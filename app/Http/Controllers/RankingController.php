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
        $user=User::orderBy('u_point','desc')->get();




        return view('Ranking',compact('user','username'));


    }
}
