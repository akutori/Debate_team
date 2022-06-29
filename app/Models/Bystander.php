<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bystander extends Model
{
    use HasFactory;
    protected $fillable = ["u_id","r_id"];
    protected $primaryKey = 'd_id';

    //傍観者を登録 引数:発言者として登録したもの,傍観者として登録したもの
    public function insert($roomid,$bystander){

        $insert = Bystander::create([
            'r_id'=>$roomid,
            'u_id'=>$bystander
        ]);
        $insert->save();
    }

}
