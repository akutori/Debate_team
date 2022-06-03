<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class genreController extends Controller
{
    public function index(){
        $cate = DB::table('category')->get();
        return view('genre',compact('cate'));
    }

}
