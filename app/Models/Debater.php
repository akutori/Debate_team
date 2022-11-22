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

    //ディベートが終わった際にルームIDを元に削除する
    public function remove_debater_by_id($user_id, $room_id){
        Debater::where("room_id","=",$room_id)->where("user_id","=",$user_id)->delete();
    }

    //ユーザーの発表者情報を取得
    public function get_the_with_an_existing_userID($userid): bool
    {
        return Debater::where('user_id',$userid)->exists();
    }

    //userの発表者情報を取り消し
    public function remove_debater_by_userid($user_id){
        Debater::where("user_id","=",$user_id)->delete();
    }

    //そのルームのすべての発表者を削除
    public function remove_debater_by_roomid($room_id){
        Debater::where("room_id","=",$room_id)->delete();
    }

    //すでに発表者として登録されているかを確認。
    public function roomedDebater($user_id,$room_id): bool
    {
       if(Debater::where("room_id","=",$room_id)->where("user_id","=",$user_id)->exists()){
           return true;
       }else{
           return false;
       }
    }

    //違う部屋ですでに登録されていた場合現在のルームに再設定する
    public function remove_duplicates_and_reconfigure_debater($user_id,$room_id){
        if (Debater::where("user_id","=",$user_id)->exists() || Bystander::where("user_id","=",$user_id)->exists()){
            Debater::where("user_id",$user_id)->delete();
            Bystander::where("user_id",$user_id)->delete();
        }
        $this->insert($room_id,$user_id);
    }
}
