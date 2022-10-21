<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    //外部キー
    protected $guarded = array('id');

     public function user(){
        return $this->belongsTo(User::class);
     }

    //ディベートが終わった際にルームIDを元に削除する
     public function remove_chat_by_id($room_id){
         Chat::where("room_id","=",$room_id)->delete();
     }
}
