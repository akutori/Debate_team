<?php

namespace App\Http\Controllers;

use App\Models\Bystander;
use App\Models\Category;
use App\Models\Debater;
use App\Models\Room;
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
            //user_idがnull(公式が作成したもの)のものを抽出
            ->where('rooms.category_id','=',$cid)->where('user_id',null)->get();
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

    public function exit_from_waiting_room($roomid,$state,$userid): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $debater = new Debater();
        $bystander = new Bystander();
        if($state==0){
            $debater->remove_debater_by_id($userid,$roomid);
        }elseif ($state==1){
            $bystander->remove_bystander_by_id($userid,$roomid);
        }

        //そのルームのカテゴリーIDを取得
        $roomonce = Room::join("titles","title_id","=","t_id")->where("r_id","=",$roomid)->first();

        //ダイアログを表示させるのに必要なコントローラー(全て)
        $room = DB::table('rooms')
            ->join('categories','rooms.category_id','=','c_id')
            ->join('titles','rooms.title_id','=','t_id')
            ->where('rooms.category_id','=',$roomonce->category_id)->get();
        $category = Category::where('c_id','=',$roomonce->category_id)->first();
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

    //ユーザー作成のルーム一覧を表示させる
    public function userindex(){
        //ダイアログを表示させるのに必要なコントローラー(全て)
        $room = DB::table('rooms')
            ->join('categories','rooms.category_id','=','categories.c_id')
            ->join('titles','rooms.title_id','=','titles.t_id')
            //user_idがnull(公式が作成したもの)のものを抽出
            ->where('user_id','!=',null)->get();

        $returnvalue = $this->de_duplication();
        $userid = $returnvalue['userid'];
        $debater_flag = $returnvalue['debater_flag'];
        $bystander_flag = $returnvalue['bystander_flag'];
        $category = $returnvalue['category'];

        return view('userrooms',compact('room','userid','debater_flag','bystander_flag','category'));
    }

    private function de_duplication(): array|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $category = Category::get();
        $userinfo = Auth::user();

        //ログインしていない場合
        if(Auth::check()){
            $userid= $userinfo['id'];
        }else{
            return redirect('/register');
        }

        return [
            'category'=>$category,
            'userid'=>$userid,
            'debater_flag'=>0,
            'bystander_flag'=>1
        ];
    }
}
