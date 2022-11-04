<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomAllController extends Controller
{
    public function index(){
        $cate = Category::all();
        $test = null;

        return view('roomAll',compact('cate','test'));
    }

    public function serach(Request $request){
        $cate = Category::all();
        $roomform = $request->all();
        switch ($roomform['user']){
            case 0://ユーザー全て
                if ($roomform['category'] == 0){
                    $room = DB::table('rooms')
                        ->join('categories','rooms.category_id','=','c_id')
                        ->join('titles','rooms.title_id','=','t_id')
                        ->get();
                }else{
                    $room = DB::table('rooms')
                        ->join('categories','rooms.category_id','=','c_id')
                        ->join('titles','rooms.title_id','=','t_id')
                        ->where('rooms.category_id','=',$roomform['category'])->get();
                }
                break;

            case 1://公式
                if ($roomform['category'] == 0){
                    $room = DB::table('rooms')
                        ->join('categories','rooms.category_id','=','c_id')
                        ->join('titles','rooms.title_id','=','t_id')
                        ->where('rooms.user_id','=',null)->get();
                }else{
                    $room = DB::table('rooms')
                        ->join('categories','rooms.category_id','=','c_id')
                        ->join('titles','rooms.title_id','=','t_id')
                        ->where('rooms.category_id','=',$roomform['category'])
                        ->where('rooms.user_id','=',null)->get();
                }
                break;

            default://ユーザー
                if ($roomform['category'] == 0){
                    $room = DB::table('rooms')
                        ->join('categories','rooms.category_id','=','c_id')
                        ->join('titles','rooms.title_id','=','t_id')
                        ->where('rooms.user_id','!=',null)->get();
                }else{
                    $room = DB::table('rooms')
                        ->join('categories','rooms.category_id','=','c_id')
                        ->join('titles','rooms.title_id','=','t_id')
                        ->where('rooms.category_id','=',$roomform['category'])
                        ->where('rooms.user_id','!=',null)->get();
                }
                break;
        }
        return view('roomAll',compact('cate','room'));
    }

}
