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

    public function insert($room_id,$user_id){
        //賛成か反対かのフラグを生成
        //0が賛成1が反対
        $flag=mt_rand(0,1);
        if($flag==0){
            $flag=false;
        }else{
            $flag=true;
        }

        //値が含まれていない場合
        //ディベーターテーブルのroomidと引数のroomidが同じものが入っていない
        //そしてd_pdの値も入っていない場合の値を取得する
        if(Debater::select()->join('rooms','r_id','=','debaters.room_id')->where('debaters.room_id','=',$room_id)->where('d_pd')->doesntExist()){
            $insert = Debater::create([
                'user_id'=>$user_id,
                'room_id'=>$room_id,
                'd_pd'=>$flag
            ]);
        }
        //0の値が含まれている場合(賛成)
        //roomidも同じカラムが1件登録されていた場合
        else if(Debater::where('d_pd','=','false')->where('debaters.room_id','=',$room_id)->exist()){
            $insert = Debater::create([
                'user_id'=>$user_id,
                'room_id'=>$room_id,
                'd_pd'=>true
            ]);
        //0の値が含まれている場合(反対)
        //roomidも同じカラムが1件登録されていた場合
        }else if(Debater::where('d_pd','=','true')->where('debaters.room_id','=',$room_id)->exist()){
            $insert = Debater::create([
                'room_id'=>$room_id,
                'user_id'=>$user_id,
                'd_pd'=>false
            ]);
        //同じroomidを持つユーザーが2人存在していた場合
        }else if(Debater::where('room_id','=',$room_id)->count()>2){
            return false;
        }
        $insert->save();
    }
}
