<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DelController extends Controller
{
    public function index(){
        //一覧表示処理
        $userinfo = Auth::user();
        $userid = $userinfo['id'];
        $rodb = DB::table('rooms')->where('user_id', $userid)->join('titles','title_id','=','t_id')->get();

        $text='';

        return view('delroom',compact('rodb','text'));
    }

    public function del($rid){
        //一覧表示処理
        $userinfo = Auth::user();
        $userid = $userinfo['id'];

        $findroom = DB::table('rooms')->where('r_id', $rid)->where('user_id', $userid)->join('titles','title_id','=','t_id')->exists();

        if ($findroom){
            $firo = new Room();
            $title_id = $firo->findroom($rid);
            DB::table('rooms')->where('r_id', '=', $rid)->delete();
            DB::table('titles')->where('t_id', '=', $title_id['title_id'])->delete();


            $text='削除しました！';
        }else{
            $text='削除できませんでした！';
        }
        //一覧表示処理（処理の順序関係で最下位）
        $rodb = DB::table('rooms')->where('user_id', $userid)->join('titles','title_id','=','t_id')->get();
        return view('delroom',compact('rodb','text'));
    }
}
