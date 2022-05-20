<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class themeController extends Controller
{
    public function index($id){
        $rooms = 6;
        $title ='タイトル';
        $day = '2022/01/21';
        $cont = '詳細の冒頭？';
        $iid = $id;
        return view('theme',compact('rooms','title','day','cont','iid'));
    }
}
