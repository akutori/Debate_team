<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index(){
        //ポイントを比較し、降順に表示


        $rank=User::select('u_point')->orderBy('u_point','desc')->get();
        $user = ["users" => $rank];
        return view('Ranking',compact('user'));


    }
}
