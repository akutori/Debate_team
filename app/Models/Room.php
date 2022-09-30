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

    protected $guarded=['r_id','r_positive','r_denial','category_id','d_pd'];
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
}
