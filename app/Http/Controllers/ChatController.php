<?php

namespace App\Http\Controllers;

use App\Models\Bystander;
use App\Models\Debater;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
        //スタートフラグが0の場合現在時刻を打刻し、スタートフラグを1にする。
        if ($stflg->timestartflg == 0){
            DB::table('rooms')->where('r_id', $roomid)->update(['Starting_time'=>Carbon::now()]);
            DB::table('rooms')->where('r_id', $roomid)->update(['timestartflg'=>1]);
        }
        //該当ルームの開始時間を取得
        $RoomStartTime = Room::where('r_id', $roomid)->select('Starting_time')->first();
        //取得した時間をカーボンにかける
        $StartTime = new Carbon($RoomStartTime->Starting_time);
        //Iso8601形式の文字列で代入
        $StartTime = $StartTime->toIso8601String();

        $user=Auth::user();
        $name = $user['name'];
        $userid= $user['id'];
        $usersposition = Debater::where("room_id",$roomid)->where("user_id",$userid)->first();
        //賛成のときはチャットのusers_positionに賛成を入れる
        if(!isset($usersposition)){
            $usersposition="";
        }else if($usersposition->d_pd==0){
            $usersposition="賛成";
        }elseif ($usersposition->d_pd==1){
            $usersposition="反対";
        }

        //1ルームの情報全てを持ってくる
        $roomdata = DB::table('rooms')
            ->join('categories','rooms.category_id','=','c_id')
            ->join('titles','rooms.title_id','=','t_id')
            ->where('r_id','=',$roomid)->first();

           return view('/chat',compact('name','roomdata','state','StartTime','stflg','usersposition'));
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
     * @param Request $request
     * @param $roomid
     * @return Application|Factory|View
     */

    public function store(Request $request,$roomid,): View|Factory|Application
    {
        $chats=new Chat;
        //チャットをAPIを使用してスコアを算出
        $chat_score = $this->check_comment($request->input('message'));
        //チャット悪性度許容レベル
        $MALIGNANCY_TOLERANCE_LEVEL = 0.6;
        //チャットの悪性度が許容量を超えた場合DBに格納する情報をBotに置き換える
        if($chat_score>=$MALIGNANCY_TOLERANCE_LEVEL){
            $message="悪質なコメントと判断したためコメントを検閲しました";
            $user_name="ЯØ|3Ø7";
            $users_position="BOT";
        }else{
            $message=$request->input('message');
            $user_name=$request->input('user_name');
            $users_position=$request->input('users_position');
        }
        //チャットの内容を全て保存
        $chats->fill(['user_id'=>$request->input('user_id'),
                      'user_name'=>$user_name,
                      'room_id'=>$request->input('room_id'),
                      'users_position'=>$users_position,
                      'message'=>$message,
                      'score'=>$chat_score])
                ->save();

        /*タイムスタンプ保存*/
        $stflg = DB::table('rooms')->where('r_id', $roomid)->select('timestartflg')->first();

        //該当ルームの開始時間を取得
        $RoomStartTime = Room::where('r_id', $roomid)->select('Starting_time')->first();
        //取得した時間をカーボンにかける
        $StartTime = new Carbon($RoomStartTime->Starting_time);
        //Iso8601形式の文字列で代入
        $StartTime = $StartTime->toIso8601String();

        $user=Auth::user();
        $name = $user['name'];
        $userid= $user['id'];
        $usersposition = Debater::where("room_id",$roomid)->where("user_id",$userid)->first();
        //賛成のときはチャットのusers_positionに賛成を入れる
        if($usersposition->d_pd==0){
            $usersposition="賛成";
        }elseif ($usersposition->d_pd==1){
            $usersposition="反対";
        }

        //1ルームの情報全てを持ってくる
        $roomdata = DB::table('rooms')
            ->join('categories','rooms.category_id','=','c_id')
            ->join('titles','rooms.title_id','=','t_id')
            ->where('r_id','=',$roomid)->first();
        $state=0;
        return view('chat',compact('roomdata','state','name','StartTime','stflg','usersposition'));
    }
    //todo 現状pserspectiveはこちらのみで取り扱うか不明なので仮置きとする
    public function check_comment($text){
        //configからenvに設定されたキーを取得
        $api_key = config('api.perspectiveAPI.public_key');
        //guzzle_client起動
        $client = new Client();
        try {
            //POST通信でURLにAPIキーを合わせ、テキスト内容とオプションを追加し送信
            $res = $client->post('https://commentanalyzer.googleapis.com/v1alpha1/comments:analyze?key='.$api_key, [
                //jsonで送信
                'json' => [
                    //実際に調査するコメント内容
                    'comment' => ['text' => $text],
                    //指定言語、デフォルトで必ず入れなければならないが、英語ならちゃんとenでレスポンスされる
                    'languages' => 'ja',
                    /*
                     * 与えられたコメント内容をどんな視点から判断するか
                     * 日本語環境では「人々がディスカッションから離れてしまう可能性がある、失礼、無礼、または不当なコメント。」の視点から見る「'TOXICITY'」のみ対応
                     * scoreTypeは現在「'PROBABILITY'」のみ対応
                     * 「'scoreThreshold'」はスコアの下限しきい値
                    */
                    'requestedAttributes' => ['TOXICITY' => ['scoreType' => 'PROBABILITY', 'scoreThreshold' => 0]],
                ],
            ]);
            //レスポンスを受け取る
            $json = json_decode($res->getBody());
            // Get the score from the JSON response.
            //コメントの悪性度のみ抽出してreturn
            return $json->attributeScores->TOXICITY->summaryScore->value;
        } catch (GuzzleException $e) {
            //エラーがー発生した場合nullを返す
            return null;
        }
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
     * @param Request $request
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
    public function getData($rid): \Illuminate\Http\JsonResponse
    {
        //チャットの履歴を全て取得
        $chats = Chat::where('room_id','=',$rid)->orderBy('created_at', 'asc')->get();
        //チャット悪性度許容レベル
        $json = ["chats" => $chats];
        return response()->json($json);
    }

    public function getDataSize($rid): \Illuminate\Http\JsonResponse
    {
        $chats = Chat::where('room_id','=',$rid)->count();
        $json = ["chat_size" => $chats];
        return response()->json($json);
    }
}
