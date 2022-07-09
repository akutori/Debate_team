<?php

namespace App\Http\Controllers;

use App\Models\Bystander;
use App\Models\Debater;
use App\Models\User;
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

        $chats= Chat::get();
        $debater = new Debater();
        $bystander= new Bystander();
        $user=Auth::user();
        $name = $user['name'];
        $userid= $user['id'];

        //傍観者で選択した場合と発表者で選択された場合の処理
        if($state == 0) {
            $debater->insert($roomid,$userid);
        }else{
            $bystander->insert($roomid, $userid);
        }

        //1ルームの情報全てを持ってくる
        $roomdata = DB::table('rooms')
            ->join('categories','rooms.category_id','=','c_id')
            ->join('titles','rooms.title_id','=','t_id')

            ->where('r_id','=',$roomid)->first();

           return view('/chat',compact('chats','name','roomdata','state'));
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
        $debater = new Debater();

        //<input type="hidden" name="user_id" value="{{$id = auth()->id()}}">に入れるために「同じ部屋の同じユーザー」を「１つだけ」持ってくる
        $inputuser = $debater->where('user_id','=',$request->user_id)->where('room_id','=',$request->room_id)->first();
        //取得したタプルからuser_idだけを代入
        $name = $inputuser['user_id'];

        $user=Auth::user();
        $userid=$user['id'];
        $name = $user['name'];

        $debater->insert($roomid,$userid);
        //1ルームの情報全てを持ってくる
        $roomdata = DB::table('rooms')
            ->join('categories','rooms.category_id','=','c_id')
            ->join('titles','rooms.title_id','=','t_id')
            ->where('r_id','=',$roomid)->first();

        $state=0;
        return view('chat',compact('chats','roomdata','state','name'));
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

    $chats = Chat::where('room_id','=',$rid)->orderBy('created_at', 'asc')->get();

    $json = ["chats" => $chats];
    return response()->json($json);
}
}
