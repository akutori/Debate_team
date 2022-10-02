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

    //ディベートが終わった際にルームIDを元に削除する
    public function remove_bystander_by_id($user_id, $room_id){
        Bystander::where("room_id","=",$room_id)->where("user_id","=",$user_id)->delete();
    }

    //同一ルームの全ての傍観者を削除
    public function remove_all_bystander_by_id($room_id){
        Bystander::where("room_id","=",$room_id)->delete();
    }

    //すでに傍観者として登録されているかを確認。
    public function roomedBystander($user_id,$room_id){
        if(Bystander::where("room_id","=",$room_id)->where("user_id","=",$user_id)->exists()){
            return 1;
        }else{
            return 0;
        }
    }

    //違う部屋ですでに登録されていた場合現在のルームに再設定する
    public function remove_duplicates_and_reconfigure_bystander($user_id,$room_id){
        if (Bystander::where("user_id","=",$user_id)->exists() || Debater::where("user_id","=",$user_id)->exists()){
            Bystander::where("user_id",$user_id)->delete();
            Debater::where("user_id",$user_id)->delete();
        }
        $this->insert($room_id,$user_id);
    }
}
