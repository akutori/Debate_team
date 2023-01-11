<?php

namespace App\Http\Controllers;


use App\Models\Bystander;
use App\Models\Category;
use App\Models\Debater;
use App\Models\Room;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;


class GenreController extends Controller
{
    public function index(){
        //直前のURLを取得
        $previousUrl = URL::previous();
        //そのURLをもとにRequestインスタンスを生成
        $requestURL = Request::create($previousUrl);
        //直前のURLが「vote」であり、かつクエリパラメータに「roomid」が含まれている場合true
        $isVoteResult = $requestURL->is('vote/result');

        //直前のURLが投票結果画面だった場合は表をリセットする
        if($isVoteResult){
            $room = new Room();
            //直前のURLからroomidというクエリパラメーターを取得
            $roomid = $requestURL->query('roomid');
            $roomtime = Room::find($roomid);
            //投票のリセット
            $room->where('r_id',$roomid)->update(["r_positive"=>0,'Starting_time'=>$roomtime->Starting_time]);
            $room->where('r_id',$roomid)->update(["r_denial"=>0,'Starting_time'=>$roomtime->Starting_time]);
        }

        $cate = Category::all();
        $ctn = 0;
        return view('genre', compact('cate', 'ctn'));
    }

    //待機画面から離席してジャンル選択に戻る
    public function exit_from_waiting_room($roomid, $state, $userid){
        $debater = new Debater();
        $bystander = new Bystander();
        switch ($state) {
            case 0:
                $debater->remove_debater_by_id($userid, $roomid);
                break;
            case 1:
                $bystander->remove_bystander_by_id($userid, $roomid);
                break;
        }

        $cate = Category::all();
        $ctn = 0;
        return view('genre', compact('cate', 'ctn'));
    }

    public function readme()
    {
        return view('readme');
    }
}
