<?php

namespace App\Http\Controllers;

use App\Models\Bystander;
use App\Models\Chat;
use App\Models\Debater;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{

    public function waituser($roomid,$state){
        $debater = new Debater();
        $bystander= new Bystander();
        $room = new Room();
        $user=Auth::user();
        $userid= $user['id'];
        //ディベートのタイトルを表示させる。
        $roomtitle = Room::join("titles","title_id","=","t_id")->where("r_id","=",$roomid)->first();

        //todo 全員が途中離脱してディベート時間が来てしまった場合新しい状態として再度ディベート待機画面に移動させる処理を追加する

        //傍観者で選択した場合と発表者で選択された場合の処理
        if($state == 0) {
            //すでに発表者として登録されているか
            if($debater->roomedDebater($userid,$roomid)==1){
                //すでにディベートは開始されているか
                if($room->is_debate_start($roomid)){
                    //発表者の賛成・反対の状態を取得
                    $debaterstate = $this->set_debaterstate($state,$userid,$roomid);
                    //途中参加
                    return view('standby',compact('roomid','state','userid','debaterstate','roomtitle'));
                }
            //発表者は2人未満 かつ 発表者として登録されていない
            }else if(($debater->countdebater($roomid) <2)&& !$debater->roomedDebater($roomid, $userid)){
                //もしすでに傍観者として登録されていた場合
                if($bystander->roomedBystander($roomid,$userid)){
                    //入室前にあった傍観者の登録を削除
                    $bystander->remove_bystander_by_id($userid,$roomid);
                }
                //違う部屋ですでに登録されていた場合現在のルームに再設定する
                //そうでない場合普通に登録
                $debater->remove_duplicates_and_reconfigure_debater($userid,$roomid);
                //発表者にすでに2人入っていた場合(新規で)
            }else if($debater->countdebater($roomid) >=2){
                return redirect('/sgenre');
            }
        //傍観者として参加した場合
        }else if($state==1){
            //傍観者として登録されているか
            if($bystander->roomedBystander($userid,$roomid)==1){
                //すでにディベートは開始されているか
                if($room->is_debate_start($roomid)){
                    //発表者の賛成・反対の状態を取得
                    $debaterstate = $this->set_debaterstate($state,$userid,$roomid);
                    //途中参加
                    return view('standby',compact('roomid','state','userid','debaterstate','roomtitle'));
                }
            }else{
                //もしすでに発表者として登録されていた場合
                if($debater->roomedDebater($userid,$roomid)==1){
                    //入室前にあった発表者の登録を削除
                    $debater->remove_debater_by_id($userid,$roomid);
                }
                //違う部屋ですでに登録されていた場合現在のルームに再設定する
                //重複がない場合普通に登録
                $bystander->remove_duplicates_and_reconfigure_bystander($userid, $roomid);
            }
        }
        //発表者の賛成・反対の状態を表示させる
        $debaterstate = $this->set_debaterstate($state,$userid,$roomid);

        //賛成と反対票をリセット
        Room::where("r_id",$roomid)->where("r_positive",">",0)->update(["r_positive"=>0]);
        Room::where("r_id",$roomid)->where("r_denial",">",0)->update(["r_denial"=>0]);

        return view('standby',compact('roomid','state','userid','debaterstate','roomtitle'));
    }

    //発表者が2人かつ傍観者が1人以上いるかを聞き続ける
    //Ajaxで使う
    public function confirmation($rid,$state){
        $debater = Debater::where('room_id','=',$rid)->count();
        $bystander = Bystander::where('room_id','=',$rid)->count();
        $json = ["debater"=>$debater,"bystander"=>$bystander,"room_id"=>$rid,"state"=>$state];

        return response()->json($json);
    }

    //発表者の賛成・反対の状態を表示させる
    public function set_debaterstate($state,$userid,$roomid): string
    {
        if($state == 0){
            $debaterstate = Debater::where('room_id',$roomid)->where('user_id',$userid)->first();
            if(($debaterstate->d_pd == 0) && $state==0){
                $debaterstate="賛成";
            }else{
                $debaterstate="反対";
            }
        }else if ($state==1){
            $debaterstate="";
        }
        return $debaterstate;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();
        $userid= $user['id'];
        return view("makeroom",compact('userid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
}
