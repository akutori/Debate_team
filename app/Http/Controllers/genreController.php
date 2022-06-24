<?php

namespace App\Http\Controllers;


use App\Models\Title;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GenreController extends Controller
{
    public function index(){
        $title = Title::all();

        return view('genre',compact('title'));
    }

}
