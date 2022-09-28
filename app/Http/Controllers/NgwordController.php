<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NgwordController extends Controller
{
    public function index(){
        return view('ngword');
    }
}
