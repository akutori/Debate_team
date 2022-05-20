<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class genreController extends Controller
{
    public function index(){
        $val = 6;
        return view('genre',compact('val'));
    }

}
