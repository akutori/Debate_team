<?php

namespace App\Http\Controllers;

use App\Models\Bystander;
use App\Models\Debater;
use App\Models\Room;
use App\Models\Title;
use Illuminate\Http\Request;

class themeController extends Controller
{
    public function index($id,Request $request){
        //ダイアログを表示させるのに必要なコントローラ
        $room = Room::where('t_id','=',$id)->get();
        //お題の情報を取得
        $roomtitle = Title::where('t_id','=',$id)->first();
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
