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
    public function index($rid)
    {
        $debater = new Debater();
        $bystander = new Bystander();
        $chat = new Chat();
        $room = new Room();
        $userinfo = Auth::user();
        $userid = $userinfo['id'];
        $rodb = DB::table('rooms')->where('r_id', $rid)->get();


        //賛成派反対派のpoint振り分け
        $r_positive = DB::table('rooms')->where('r_id', $rid)->where('r_positive', true)->get();
        $r_denial = DB::table('rooms')->where('r_id', $rid)->where('r_denial', true)->get();
        $position_p = $debater->where('room_id', $rid)->where('d_pd', 0)->first();
        //DB::table('debaters')->where('room_id',$rid)->where('d_pd',0)->get();
        $position_d = $debater->where('room_id', $rid)->where('d_pd', 1)->first();
        //DB::table('debaters')->where('room_id',$rid)->where('d_pd',1)->get();

        $room->where('r_id', $rid)->first();

        //賛成派の勝利
        if ($debater->roomedDebater($userid,$rid)==1) {

            if ($r_positive > $r_denial) {
                if ($position_p->d_pd == 0) {
                    if ($position_p->user_id == $userid) {
                        DB::table('users')->where('id', $userid)->increment('u_point', 10);
                    }
                } //反対派の勝利・
            }
                if ($r_denial > $r_positive) {
                    if ($position_d->d_pd == 1) {
                        if ($position_d->user_id == $userid) {
                            //debaterの勝った側（d_pd）のuseridとuserテーブルのidを結びつける。
                            DB::table('users')->where('id', $userid)->increment('u_point', 10);
                        }
                    }
                }
                $this->deletedebate($rid);
        }




        //部屋のスタートフラグを0にする
        Room::where("r_id", $rid)->where("timestartflg", "=", 1)->update(["timestartflg" => 0]);
        return view('vote', compact('rodb', 'rid'));

    }
    public function deletedebate($rid){
        $debater = new Debater();
        $bystander = new Bystander();
        $chat = new Chat();
        $userinfo = Auth::user();
        $userid = $userinfo['id'];

        //各ユーザーの登録を削除
        $debater->remove_debater_by_id($userid, $rid);
        $bystander->remove_bystander_by_id($userid, $rid);

        //チャットの履歴を削除
        $chat->remove_chat_by_id($rid);
    }
}


