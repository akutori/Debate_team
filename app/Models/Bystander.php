<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bystander extends Model
{
    use HasFactory;
    protected $guarded = ["b_id"];
    protected $primaryKey = 'b_id';
    public $timestamps=false;

    //傍観者を登録 引数:発言者として登録したもの,傍観者として登録したもの
    public function insert($roomid,$bystander){

        $insert=Bystander::create([
            'room_id'=>$roomid,
            'user_id'=>$bystander
        ]);
        $insert->save();
    }

    public function remove_debater_by_id($user_id,$room_id,$state){
        //同じルームIDかつ同じユーザIDなのに状態が発表者だった場合
        if((Bystander::where("room_id","=",$room_id)->where("user_id","=",$user_id)->get()->exists())&& $state==0){
            Bystander::where("room_id","=",$room_id)->where("user_id","=",$user_id)->delete();
        }
    }
}
