<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class votesumController extends Controller
{
    public function ko(){
        $bydb = DB::select('UPDATE rooms SET r_denial = r_denial + 1 WHERE r_id = 1');
        return view('votesum');
    }
    public function san(){
        $bydb = DB::select('UPDATE rooms SET r_positive = r_positive + 1 WHERE r_id = 1');
        return view('votesum');
    }
    public function index(){
        return view('votesum');
    }
}
