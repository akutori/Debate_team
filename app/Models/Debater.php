<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debater extends Model
{
    use HasFactory;
    protected $guarded = ['d_id'];
    protected $primaryKey = 'd_id' ;
    public $timestamps=false;

    public function countdebater($room_id){
        $debatercount = Debater::where('room_id','=',$room_id)->count();
        return $debatercount;
    }

    public function insert($room_id,$user_id){
        //賛成か反対かのフラグを生成
        //0が賛成1が反対
        $flag=mt_rand(0,1);
        if($flag==0){
            $flag=0;
        }else{
            $flag=1;
        }
        //0の値が含まれている場合(反対)
        //roomidも同じカラムが1件登録されていた場合

        if(Debater::where('d_pd','=',1)->where('debaters.room_id','=',$room_id)->exists()){
            $insert = Debater::create([
                'user_id'=>$user_id,
                'room_id'=>$room_id,
                'd_pd'=>0
            ]);
        }
        //0の値が含まれている場合(賛成)
        //roomidも同じカラムが1件登録されていた場合
        else if(Debater::where('d_pd','=',0)->where('debaters.room_id','=',$room_id)->exists()){
            $insert = Debater::create([
                'user_id'=>$user_id,
                'room_id'=>$room_id,
                'd_pd'=>1
            ]);
        //値が含まれていない場合
        //ディベーターテーブルのroomidと引数のroomidが同じものが入っていない
        //そしてd_pdの値も入っていない場合の値を取得する
        }else if(Debater::where('room_id','=',$room_id)->doesntExist()){
            $insert = Debater::create([
                'room_id'=>$room_id,
                'user_id'=>$user_id,
                'd_pd'=>$flag
            ]);
        //同じroomidを持つユーザーが2人存在していた場合
        }else if(Debater::where('room_id','=',$room_id)->count()>2){
            return false;
        }
        $insert->save();
    }

    public function first_check_debater($roomid,$userid){
        return $check =['countdebater'=>$this->countdebater($roomid),'roomeddebater'=>$this->roomedDebater($roomid, $userid)];
    }

    //ディベートが終わった際にルームIDを元に削除する
    public function remove_debater_by_id($user_id, $room_id){
        Debater::where("room_id","=",$room_id)->where("user_id","=",$user_id)->delete();
    }

    //すでに発表者として登録されているかを確認。
    public function roomedDebater($user_id,$room_id){
       if(Debater::where("room_id","=",$room_id)->where("user_id","=",$user_id)->exists()){
           return 1;
       }else{
           return 0;
       }
    }
}
