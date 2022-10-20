<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class votesumController extends Controller
{
    public function point($u_point){


    }

    public function ko($rid){
        $bydb = DB::table('rooms')->where('r_id', $rid)->increment('r_positive');
        return view('votesum',compact('rid'));

    }
    public function san($rid){
        $bydb = DB::table('rooms')->where('r_id', $rid)->increment('r_denial');
        return view('votesum',compact('rid'));
    }

    public function index($rid){
        return view('votesum',compact('rid'));
    }
}
