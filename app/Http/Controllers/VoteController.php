<?php

namespace App\Http\Controllers;

use App\Models\Debater;
use App\Models\Room;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class VoteController extends Controller
{
    //
    public function index(Request $request): View|Factory|Redirector|RedirectResponse|Application
    {

        //直前のURLを取得
        $previousUrl = URL::previous();
        //そのURLをもとにRequestインスタンスを生成
        $requestURL = Request::create($previousUrl);
        //直前のURLが、/chat/*のパスを含むかどうかを判定する
        $isChat = $requestURL->is('chat/*');
        //直前のURLが待機室ではなかった場合はマイページにリダイレクト
        if(!$isChat){
            return redirect('/mypage');
        }

        $roomid = $request->input('roomid');
        $debater = new Debater();
        $debater_flag=null;
        if($debater->roomedDebater(Auth::id(),$roomid)){
            $debater_flag=1;
            return view('vote',compact('roomid','debater_flag'));
        }
        return view('vote',compact('roomid','debater_flag'));
    }

    //投票(Ajax)
    public function VoteCounting(Request $request){
        $room = new Room();
        $vote = $request->input('vote');
        $roomid = $request->input('roomid');
        $tihsroom = Room::find($roomid);
        switch ($vote){
            case 0: return $room->where('r_id', $roomid)->update(['r_denial'=>DB::raw('r_denial + 1'),'Starting_time'=>$tihsroom->Starting_time]);
            case 1: return $room->where('r_id', $roomid)->update(['r_positive'=>DB::raw('r_positive + 1'),'Starting_time'=>$tihsroom->Starting_time]);
            default: return null;
        }
    }

    public function VoteResult(Request $request): View|Factory|Redirector|RedirectResponse|Application
    {

        //直前のURLを取得
        $previousUrl = URL::previous();
        //そのURLをもとにRequestインスタンスを生成
        $requestURL = Request::create($previousUrl);
        //直前のURLが「vote」であり、かつクエリパラメータに「roomid」が含まれている場合true
        $isVote = $requestURL->is('vote') && $requestURL->query('roomid');

        //直前のURLが投票画面ではなかった場合はマイページにリダイレクト
        if(!$isVote){
            return redirect('/mypage');
        }

        $debater = new Debater();
        $room = new Room();
        $userinfo = Auth::user();
        $userid = $userinfo['id'];
        $rid = $request->input('roomid');
        $rodb = DB::table('rooms')->where('r_id', $rid)->get();
        $roomtime = Room::find($rid);
        //賛成派反対派のpoint振り分け
        //賛成票取得
        $r_positive = DB::table('rooms')->where('r_id', $rid)->where('r_positive', true)->get();
        //反対票取得
        $r_denial = DB::table('rooms')->where('r_id', $rid)->where('r_denial', true)->get();
        //賛成派の発表者を取得
        $position_p = $debater->where('room_id', $rid)->where('d_pd', 0)->first();
        //反対派の発表者を取得
        $position_d = $debater->where('room_id', $rid)->where('d_pd', 1)->first();

        $room->where('r_id', $rid)->first();

        //賛成派の勝利
        if ($debater->roomedDebater($userid, $rid)) {
            if ($r_positive > $r_denial) {
                if ($position_p->d_pd == 0) {
                    if ($position_p->user_id == $userid) {
                        DB::table('users')->where('id', $userid)->increment('u_point', 10);
                    }
                }
            }
            //反対派の勝利・
            if ($r_denial > $r_positive) {
                if ($position_d->d_pd == 1) {
                    if ($position_d->user_id == $userid) {
                        //debaterの勝った側（d_pd）のuseridとuserテーブルのidを結びつける。
                        DB::table('users')->where('id', $userid)->increment('u_point', 10);
                    }
                }
            }
        }

        return view('voteresult', compact('rodb', 'rid'));
    }
}
