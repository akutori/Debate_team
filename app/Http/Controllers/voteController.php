<?php

namespace App\Http\Controllers;

use App\Models\Bystander;
use App\Models\Chat;
use App\Models\Debater;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class voteController extends Controller
{
    public function index($rid){
        $debater = new Debater();
        $bystander = new Bystander();
        $chat = new Chat();
        $userinfo = Auth::user();
        $userid = $userinfo['id'];
        $rodb = DB::table('rooms')->where('r_id', $rid)->get();

        //各ユーザーの登録を削除
        $debater->remove_debater_by_id($userid,$rid);
        $bystander->remove_bystander_by_id($userid,$rid);

        //チャットの履歴を削除
        $chat->remove_chat_by_id($rid);

        //部屋のスタートフラグを0にする
        Room::where("r_id",$rid)->where("timestartflg","=",1)->update(["timestartflg"=>0]);
        return view('vote',compact('rodb','rid'));
    }
}
