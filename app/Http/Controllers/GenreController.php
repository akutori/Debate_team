<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GenreController extends Controller
{
    public function index(){
        $cate = Category::all();
        $ctn =0;
        return view('genre',compact('cate','ctn'));
    }


}
