<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debater extends Model
{
    use HasFactory;
    protected $fillable = ["room_id","user_id"];
    protected $primaryKey = 'd_id' ;

    public function insert($room_id,$user_id){
        //賛成か反対かのフラグを生成
        //0が賛成1が反対
        $flag=random_int(0,1);

        //値が含まれていない場合
        //ディベーターテーブルのroomidと引数のroomidが同じものが入っていない
        //そしてd_pdの値も入っていない場合の値を取得する
        if(Debater::select()->join('rooms','r_id','=','debaters.room_id')->where('debaters.room_id','=',$room_id)->doesntExist()->where('d_pd')->doesntExist()->get()){
            $insert = Debater::create([
                'user_id'=>$user_id,
                'room_id'=>$room_id,
                'd_pd'=>$flag
            ]);
        }
        //0の値が含まれている場合(賛成)
        //roomidも同じカラムが1件登録されていた場合
        else if(Debater::where('d_pd','=','0')->where('debaters.room_id','=',$room_id)->get()==1){
            $insert = Debater::create([
                'user_id'=>$user_id,
                'room_id'=>$room_id,
                'd_pd'=>1
            ]);
        //0の値が含まれている場合(反対)
        //roomidも同じカラムが1件登録されていた場合
        }else if(Debater::where('d_pd','=','1')->where('debaters.room_id','=',$room_id)->get()==1){
            $insert = Debater::create([
                'room_id'=>$room_id,
                'user_id'=>$user_id,
                'd_pd'=>0
            ]);
        //同じroomidを持つユーザーが2人存在していた場合
        }else if(Debater::where('room_id','=',$room_id)->get()==2){
            return;
        }
        $insert->save();
    }
}
