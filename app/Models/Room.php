<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Room extends Model
{
    use HasFactory;

    protected $guarded='r_id';
    protected $primaryKey = 'r_id';
    public $timestamps = false;

    // todo 先にカテゴリーを格納してからこちらのメソッドを使用する
    //部屋を作成する roomsum=傍観者数
    public function insert($cateid,$userid)
    {
        $title = new Title();
        $titleid = $title->getLastTitleData();
        //今日の日付を取得
        // composer require nesbot/carbon を使用
        $today = new Carbon('today');
        return Room::create([
            'title_id'=>$titleid['t_id'],
            'category_id'=>$cateid,
            'r_day'=>$today,
            'user_id'=>$userid
        ]);
    }

    //一部屋にいる特定のユーザーを抽出
    public function Select_Specific_Users(){
        return Room::find();
    }

    //すでにディベートが開始されているか
    public function is_debate_start($room_id):bool{
       return Room::where("r_id",$room_id)->where("timestartflg","=",1)->exists();
    }

    //今いるルームのディベート時間がすでに終了時間を超過しているか
    public function this_room_debate_time_end($roomid,$userid){

        //発表者クラス
        $debater = new Debater();
        //傍観者クラス
        $bystander = new Bystander();
        //チャットクラス
        $chat = new Chat();
        //現在時間を取得
        $nowtime = new Carbon();

        //現在いる部屋を取得
        $room = Room::where("r_id",$roomid)->first();

        //Carbonインスタンスを生成。時間はルームのディベート開始時刻
        $debateendtime = new Carbon($room->Starting_time);
        //ディベートの終了時刻を設定
        //$debateendtime->addMinutes(10);
        $debateendtime->addSeconds(30);
        //現在時刻がディベート終了時刻よりも大きい場合
        if($nowtime->lt($debateendtime)){
            /*//各ユーザーの登録を削除
            $debater->remove_debater_by_id($userid,$roomid);
            $bystander->remove_bystander_by_id($userid,$roomid);

            //チャットの履歴を削除
            $chat->remove_chat_by_id($roomid);*/
            return true;
        }else{
            return false;
        }
    //そのユーザーが作成したルーム数が規定以上だった場合trueを返す
    //todo 作成限度数は未定
    public function Is_the_users_room_creation_limit($userid):bool{
        //ユーザーが作成した
        $roomdata = Room::where("user_id",$userid)->count()->get();
        //作成上限である3件を超過している場合trueを返す
        return $result = $roomdata > 4;
    }
}
