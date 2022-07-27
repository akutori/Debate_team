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

    //部屋を作成する roomsum=傍観者数
    protected function insert(Request $request,$tid)
    {
        //タイトルテーブルのタイトルIDが引数と同じ箇所を取得
        $titleid=Title::where('t_id','=',$tid)->get();
        //今日の日付を取得
        // composer require nesbot/carbon を使用
        $today = new Carbon('today');
        return Room::create([
            't_id'=>$titleid,
            'r_day'=>$today,
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

    //今いるルームのディベート時間がすでに終了時間を超過しているかを判定
    public function this_room_debate_time_end($roomid){
        //チャットクラス
        $chat = new Chat();
        //現在時間を取得
        $now = Carbon::parse('now');

        //現在いる部屋を取得
        $room = Room::where("r_id",$roomid)->first();

        //Carbonインスタンスを生成。時間はルームのディベート開始時刻
        $debateendtime = new Carbon($room->Starting_time);

        //同じ日か
        if($now == $debateendtime){

            //ディベートの終了時刻を設定
            $debateendtime->addMinutes(10);

            //現在の「時」を取得
            $nowhour = $now->hour;
            //ディベートの終了「時」を取得
            $debatehour = $debateendtime->hour;

            //$debateendtime->addSeconds(30);

            //現在時間がディベート終了の「時間」内にいるか
            if($nowhour < $debatehour){

                //現在の「分」を取得
                //$nowminute = $now->minute;
                //ディベート時間の「分」を取得
                //$debateminute = $debateendtime->minute;

                //現在時間とディベート終了予定時間の差が10分以内か
                if($now->diffInMinutes($debateendtime) < 10 ){
                    //現在の秒を取得
                    //$nowsecond= $now->second;
                    //$debatesecond= $debateendtime->second;
                    /*if($now->diffInSeconds($debateendtime) < 30){
                        return false;
                    }*/

                    //ディベートはまだ続いている
                    return false;
                }else{
                    //終了分を超過しているのでディベートは終了している
                    return true;
                }
            }else{
                //すでにディベート終了予定時刻を過ぎている
                //まだ時間内なのでディベート続いている可能性がある
                return true;
            }
        }else{
            //違う日なのでディベートは終了している
            return true;
        }
    }
}
