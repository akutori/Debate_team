<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class voteController extends Controller
{
    public function index(){
        $rodb = DB::select('SELECT * FROM rooms WHERE r_id = 1');
        return view('vote',compact('rodb'));
    }
}
