<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomAllController extends Controller
{
    public function index(){
        return view('roomAll');
    }

}
