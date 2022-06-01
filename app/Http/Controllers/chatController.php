<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class chatController extends Controller
{
    public function index($rid){
        $roid = $rid;
        return view('chat',compact('rid'));
    }
}
