<?php

namespace App\Http\Controllers;

use App\Models\Bystander;
use App\Models\Debater;
use App\Models\Category;
use App\Models\Room;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ThemeController extends Controller
{
    public function index(Request $request,$cid){
        //ダイアログを表示させるのに必要なコントローラー(全て)
        $room = DB::table('rooms')
            ->join('categories','rooms.category_id','=','c_id')
            ->join('titles','rooms.title_id','=','t_id')
            ->where('rooms.category_id','=',$cid)->get();
        $category = Category::where('c_id','=',$cid)->first();
        $userinfo = Auth::user();

//todo ログインしていない場合loginに移動
            $userid= $userinfo['id'];

        $debater_flag=0;
        $bystander_flag=1;

        return view('theme',compact('room','userid','debater_flag','bystander_flag','category'));
    }
}
