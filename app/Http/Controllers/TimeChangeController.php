<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimeChangeController extends Controller
{
    public function index(){
        return view('timeChange');
    }
}
