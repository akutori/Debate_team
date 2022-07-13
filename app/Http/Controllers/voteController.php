<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class voteController extends Controller
{
    public function index($rid){
        $rodb = DB::table('rooms')->where('r_id', $rid)->get();
        return view('vote',compact('rodb','rid'));
    }
}
