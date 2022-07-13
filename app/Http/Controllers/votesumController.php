<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class votesumController extends Controller
{
    public function ko($rid){
        $bynum = DB::table('rooms')->where('r_id', $rid)->select('r_denial')->get();
        $bynum2= $bynum->r_denial + 1;
        $bydb = DB::table('rooms')->where('r_id', $rid)->update(['r_denial'=>$bynum2]);
        return view('votesum',compact('rid'));
    }
    public function san($rid){
        $bynum = DB::table('rooms')->where('r_id', $rid)->select('r_positive')->get();
        $bynum2= $bynum->r_positive + 1;
        $bydb = DB::table('rooms')->where('r_id', $rid)->update(['r_positive'=>5]);
        return view('votesum',compact('rid'));
    }
    public function index($rid){
        return view('votesum',compact('rid'));
    }
}
