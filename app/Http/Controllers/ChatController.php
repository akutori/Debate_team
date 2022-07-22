<?php

namespace App\Http\Controllers;

use App\Models\Bystander;
use App\Models\Debater;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($roomid,$state){
        /*タイムスタンプ保存*/
        $stflg = DB::table('rooms')->where('r_id', $roomid)->select('timestartflg')->first();
        if ($stflg->timestartflg == 0){
            $bydb = DB::table('rooms')->where('r_id', $roomid)->update(['Starting_time'=>Carbon::now()]);
            $bydb1 = DB::table('rooms')->where('r_id', $roomid)->update(['timestartflg'=>1]);
        }

        $st = DB::table('rooms')->where('r_id', $roomid)->select('Starting_time')->first();
        //ディベート時間(秒)
        $max=300;

        $stt = new Carbon($st->Starting_time);
        $stb = $stt->second;
        $stmm = $stt->minute;
        $stm = (int)$stmm*60;
        $stsum=(int)$stb+$stm;

        $now = Carbon::now();
        $nowb = $now->second;
        $nowmm = $now->minute;
        $nowm = (int)$nowmm*60;
        $nowsum = (int)$nowb+ $nowm;

        $tim = $max-($nowsum-$stsum);


        //チャット履歴を取得
        //$chats= Chat::where("room_id",$roomid)->get();

        $user=Auth::user();
        $name = $user['name'];
        $userid= $user['id'];
        $usersposition = Debater::where("room_id",$roomid)->where("user_id",$userid)->first();
        //賛成のときはチャットのusers_positionに賛成を入れる
        if(!isset($usersposition)){
            $usersposition="";
        }else if(isset($usersposition) && $usersposition->d_pd==0){
            $usersposition="賛成";
        }elseif (isset($usersposition) && $usersposition->d_pd==1){
            $usersposition="反対";
        }


        //1ルームの情報全てを持ってくる
        $roomdata = DB::table('rooms')
            ->join('categories','rooms.category_id','=','c_id')
            ->join('titles','rooms.title_id','=','t_id')

            ->where('r_id','=',$roomid)->first();

        return view('/chat',compact('name','roomdata','state','st','tim','stflg','usersposition'));
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function store(Request $request,$roomid,){
        $chats=new Chat;
        //チャットの内容を全て保存
        $chats->fill($request->all())->save();

        /*タイムスタンプ保存*/
        $stflg = DB::table('rooms')->where('r_id', $roomid)->select('timestartflg')->first();
        if ($stflg->timestartflg == 0){
            $bydb = DB::table('rooms')->where('r_id', $roomid)->update(['Starting_time'=>Carbon::now()]);
            $bydb1 = DB::table('rooms')->where('r_id', $roomid)->update(['timestartflg'=>1]);

        }

        $st = DB::table('rooms')->where('r_id', $roomid)->select('Starting_time')->first();
        $max=30;

        $stt = new Carbon($st->Starting_time);
        $stb = $stt->second;
        $stmm = $stt->minute;
        $stm = (int)$stmm*60;
        $stsum=(int)$stb+$stm;

        $now = Carbon::now();
        $nowb = $now->second;
        $nowmm = $now->minute;
        $nowm = (int)$nowmm*60;
        $nowsum = (int)$nowb+ $nowm;

        $tim = $max-($nowsum-$stsum);

        //チャット履歴を取得
        //$chats= Chat::where("room_id",$roomid)->get();

        $user=Auth::user();
        $name = $user['name'];
        $userid= $user['id'];

        //1ルームの情報全てを持ってくる
        $roomdata = DB::table('rooms')
            ->join('categories','rooms.category_id','=','c_id')
            ->join('titles','rooms.title_id','=','t_id')
            ->where('r_id','=',$roomid)->first();

        $usersposition = Debater::where("room_id",$roomid)->where("user_id",$userid)->first();
        //賛成のときはチャットのusers_positionに賛成を入れる
        if($usersposition->d_pd==0){
            $usersposition="賛成";
        }elseif ($usersposition->d_pd==1){
            $usersposition="反対";
        }

        $state=0;
        return view('chat',compact('roomdata','state','name','st','tim','stflg','usersposition'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getData($rid)
    {
        //チャットの履歴を全て取得
        $chats = Chat::where('room_id','=',$rid)->orderBy('created_at', 'asc')->get();
        $json = ["chats" => $chats];
        return response()->json($json);
    }
}
