<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        //ログインしていない場合
        if(Auth::check()){
            $userid= $userinfo['id'];
        }else{
            return redirect('/register');
        }

        $debater_flag=0;
        $bystander_flag=1;

        return view('theme',compact('room','userid','debater_flag','bystander_flag','category'));
    }
}
