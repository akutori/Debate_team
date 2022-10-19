<?php

namespace App\Http\Controllers;

use App\Models\Bystander;
use App\Models\Category;
use App\Models\Chat;
use App\Models\Debater;
use App\Models\Room;
use App\Models\Title;
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
        //傍観者で選択した場合と発表者で選択された場合の処理
        if($state == 0) {
            //すでに発表者として登録されているか
            if($debater->roomedDebater($userid,$roomid)){
                //すでにディベートは開始されているか
                if($room->is_debate_start($roomid)){
                    //ディベートの終了時刻を過ぎているか
                    if($room->this_room_debate_time_end($roomid)){
                        $this->removedebate($roomid,$userid);
                        $debater->remove_duplicates_and_reconfigure_debater($roomid,$userid);
                    }
                    //発表者の賛成・反対の状態を取得
                    $debaterstate = $this->set_debaterstate($state,$userid,$roomid);
                    //途中参加
                    return view('standby',compact('roomid','state','userid','debaterstate','roomtitle'));
                }
            }
            //ディベートが始まっていてまだ終了していないが傍観者としてもともと登録されていた場合立場を変更させずに再入室させる
            if(!$room->this_room_debate_time_end($roomid)&&$bystander->roomedBystander($userid,$roomid)){
                $state=1;
                //同じ部屋の場合は立場を変更せずにそのまま参加させる
                return view('standby',compact('roomid','state','userid','roomtitle'));
            }
            //発表者は2人未満 かつ 発表者として登録されていない
            if(($debater->countdebater($roomid) <2)&& !$debater->roomedDebater($roomid, $userid)){
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
            if($bystander->roomedBystander($userid,$roomid)){
                //すでにディベートは開始されているか
                if($room->is_debate_start($roomid)){
                    //ディベートの終了時刻を過ぎているか
                    if($room->this_room_debate_time_end($roomid)){
                        $this->removedebate($roomid,$userid);
                        $bystander->remove_duplicates_and_reconfigure_bystander($roomid,$userid);
                    }
                    return view('standby',compact('roomid','state','userid','roomtitle'));
                }
            }//ディベートが始まっていてまだ終了していないが発表者としてもともと登録されていた場合立場を変更させずに再入室させる
            if(!$room->this_room_debate_time_end($roomid)&&$debater->roomedDebater($userid,$roomid)){
                //発表者の賛成・反対の状態を取得
                $state=0;
                $debaterstate = $this->set_debaterstate($state,$userid,$roomid);
                //同じ部屋の場合は立場を変更せずにそのまま参加させる
                return view('standby',compact('roomid','state','userid','debaterstate','roomtitle'));
            }
            //もしすでに発表者として登録されていた場合
            if($debater->roomedDebater($userid,$roomid)){
                //入室前にあった発表者の登録を削除
                $debater->remove_debater_by_id($userid,$roomid);
            }elseif($debater->roomedDebater($userid,$roomid)){
                //発表者の賛成・反対の状態を取得
                $debaterstate = $this->set_debaterstate($state,$userid,$roomid);
                return view('standby',compact('roomid','state','userid','debaterstate','roomtitle'));
            }
            //違う部屋ですでに登録されていた場合現在のルームに再設定する
            //重複がない場合普通に登録
            $bystander->remove_duplicates_and_reconfigure_bystander($userid, $roomid);

        }
        //発表者の賛成・反対の状態を表示させる
        $debaterstate = $this->set_debaterstate($state,$userid,$roomid);
        //賛成と反対票をリセット
        Room::where("r_id",$roomid)->where("r_positive",">",0)->update(["r_positive"=>0]);
        Room::where("r_id",$roomid)->where("r_denial",">",0)->update(["r_denial"=>0]);

        return view('standby',compact('roomid','state','userid','debaterstate','roomtitle'));
    }

    //すべてのディベートの情報を削除
    public function removedebate($roomid,$userid){
        $debater = new Debater();
        $bystander= new Bystander();
        $room = new Room();
        $chat = new Chat();
        //そのルームの発表者を削除
        $debater->remove_debater_by_roomid($roomid);
        //そのルームの傍観者を削除
        $bystander->remove_bystander_by_roomid($roomid);
        //そのルームのチャット内容を削除
        $chat->remove_chat_by_id($roomid);
        $room->where('r_id',$roomid)->update(["timestartflg" => 0]);
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
            if(isset($debaterstate)&&$debaterstate->d_pd == 0){
                //賛成
                $debaterstate=0;
            }else{
                //反対
                $debaterstate=1;
            }
        }else if ($state==1){//傍観者の場合
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
        $categorys = Category::all();
        return view("makeroom",compact('userid','categorys'));
    }

    /**
     * Show the form for creating a new resource.
     * 新規リソースの作成フォームを表示します。
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $room = new Room();
        $title = new Title();
        $categorys = Category::all();
        //フォームからすべてのinput要素から値を取り出す
        $formdata = $request->all();
        //同じビューにもどってくるためもう一度useridを取得する必要がある
        $userid = $formdata['userid'];
        //アラート用にcategoryIDからcategory名を取得
        $catgory = Category::where('c_id',$formdata['categoryid'])->first();
        //ユーザーが作成したルームが上限を超過しているか
        $isRoomCreateLimit = $room->Is_the_users_room_creation_limit($formdata['userid']);
        //超過していなければ登録する
        if($isRoomCreateLimit){
            $alerttext = '
                <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" role="alert" id="createalert">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-exclamation-triangle flex-shrink-0 me-2" viewBox="0 0 16 15">
                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
            </svg>
            <div class="container">
                <button type="button" class="btn-close float-end border-0 bg-transparent" data-bs-dismiss="alert" aria-label="Close"></button>
                <h4 class="alert-heading m-3">ルームの作成上限に達しました!!</h4>
                <hr>
                <p class="m-3">新たにルーム作成を行う場合は「マイページ」から部屋の削除を行ってください</p>
            </div>
        </div>
            ';
        }else{
            //お題から登録する。そうしないとroomから作成した場合に無いものを入れることになる
            $title->insert($formdata['title'],(int)$formdata['categoryid']);
            $room->insert((int)$formdata['categoryid'],(int)$formdata['userid']);

            $alerttext='
                <div class="alert alert-success alert-dismissible d-flex align-items-center fade show alert-heading" role="alert" id="alertclose">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check2-circle flex-shrink-0 me-2" viewBox="0 0 16 15">
                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                </svg>
                <div class="container">
                    <button type="button" class="btn-close float-end border-0 bg-transparent" data-bs-dismiss="alert" aria-label="Close" ></button>
                    <h4 class="alert-heading m-3">新規作成が完了しました!!</h4>
                    <hr>
                    <p class="m-3">カテゴリー : 「'.$catgory->c_name.'」</p>
                    <p class="m-3">お題 : 「'.$formdata['title'].'」</p>
                </div>
            </div>
            ';
        }
        return view("makeroom",compact('userid','alerttext','categorys'));
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
