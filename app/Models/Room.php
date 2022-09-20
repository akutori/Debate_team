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

    //そのユーザーが作成したルーム数が規定以上だった場合trueを返す
    //todo 作成限度数は未定
    public function Is_the_users_room_creation_limit($userid):bool{
        //ユーザーが作成した
        $roomdata = Room::where("user_id",$userid)->count()->get();
        //作成上限である3件を超過している場合trueを返す
        return $result = $roomdata > 4;
    }
}
