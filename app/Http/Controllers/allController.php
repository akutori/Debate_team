<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class allController extends Controller
{
    public function index(){
        $bydb = DB::table('users')->get();
        return view('all',compact('bydb'));
    }
}
