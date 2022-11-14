<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

class Room extends Model
{
    use HasFactory;

    protected $guarded = ['r_id'];
    protected $primaryKey = 'r_id';
    public $timestamps = false;

    //部屋を作成する roomsum=傍観者数
    public function insert($cateid, $userid)
    {
        $title = new Title();
        $titleid = $title->getLastTitleData();
        //今日の日付を取得
        // composer require nesbot/carbon を使用
        $today = new Carbon();
        return Room::create([
            'title_id' => $titleid['t_id'],
            'category_id' => $cateid,
            'r_day' => $today,
            'user_id' => $userid,
            'Starting_time'=>$today,
        ]);
    }

    //すでにディベートが開始されているか
    public function is_debate_start($room_id): bool
    {
        return Room::where("r_id", $room_id)->where("timestartflg", "=", 1)->exists();
    }

    //そのユーザーが作成したルーム数が規定以上だった場合trueを返す
    public function Is_the_users_room_creation_limit($userid): bool
    {
        //ユーザーが作成した
        $roomdata = Room::where("user_id", $userid)->count();
        //作成上限である3件を超過している場合trueを返す
        if ($roomdata >= 3) {
            return true;
        } else {
            return false;
        }
    }

    //今いるルームのディベート時間がすでに終了時間を超過しているかを判定
    // true->終了 false->ディベート続行
    public function this_room_debate_time_end($roomid): bool
    {
        //ディベート終了(分)
        $END_TIME = 15;
        //現在時間を取得
        $Today = Carbon::now()->setTimezone('Asia/Tokyo');
        //現在いる部屋を取得
        $Room = Room::where("r_id", $roomid)->first();
        //Carbonインスタンスを生成。時間はルームのディベート開始時刻
        $Debate_End_Time = new Carbon($Room->Starting_time,'Asia/Tokyo');
        //同じ日
        if ($Debate_End_Time->isToday()) {
            //ディベートの終了時刻を設定
            $Debate_End_Time->addMinutes($END_TIME);
            //現在時間とディベート終了予定時間の差が終了時間以内か
            if ($Today->minute < $Debate_End_Time->minute) {
                //比較分の差が終了時間以下なのでディベートは続いている
                return false;
            }
            //終了分を超過しているのでディベートは終了している
            return true;
        }
        //ディベートの終了時刻を設定
        $Debate_End_Time->addMinutes($END_TIME);
        //今日の時間とディベートが終了時刻の差が15分以上ある
        if($Today->diffInMinutes($Debate_End_Time) > $END_TIME){
            //日付をまたいで15分経過しているのでディベートは終了している
            return true;
        }else{
            //比較分の差が終了時間以下なのでディベートは続いている
            return false;
        }
    }

    public function findroom($room_id){
        return Room::where("r_id", $room_id)->first();
    }
}
