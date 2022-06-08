<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Title;
use Illuminate\Http\Request;

class themeController extends Controller
{
    public function index($id){
        //ダイアログを表示させるのに必要なコントローラー
        $room = Room::where('t_id','=',$id);
        //お題の情報を取得
        $roomtitle = Title::where('t_id','=',$id);
        /*
        $rooms = 6;
        $title ='タイトル';
        $day = '2022/01/21';

        $iid = $id;
        */
        $cont = '詳細の冒頭？';
        return view('theme',compact('room','roomtitle','cont'));
    }
}
