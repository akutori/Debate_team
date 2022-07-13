<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class vote2Controller extends Controller
{
    public function index($rid){
        $flg=0;
        $user=Auth::user();
        $userid= $user['id'];
        $vote = DB::table('bystanders')->where('bystanders.user_id', $userid)->where('bystanders.room_id', $rid)->count();
        $bydb = DB::table('bystanders')->where('bystanders.room_id', $rid)->get();

        if ($vote == 1){
            $flg = 1;
        }
        return view('vote2',compact('bydb','vote','flg','rid'));
    }
}
