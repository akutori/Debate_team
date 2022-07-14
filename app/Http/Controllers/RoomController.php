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
        $user=Auth::user();
        $userid= $user['id'];

        //ディベートのタイトルを表示させる。
        $roomtitle = Room::join("titles","title_id","=","t_id")->where("r_id","=",$roomid)->first();

        //傍観者で選択した場合と発表者で選択された場合の処理
        if($state == 0) {
            //同じroom_idの発表者が2人未満の場合insert2人以上いた場合はsgenreにリダイレクトさせる
            if($debater->countdebater($roomid) <2){
                $debater->insert($roomid,$userid);
            }else if($debater->countdebater($roomid) >=2){
                return redirect('/sgenre');
            }
        }else{
            $bystander->insert($roomid, $userid);
        }

        //発表者の賛成・反対の状態を表示させる
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
