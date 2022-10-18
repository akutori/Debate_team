<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    //ホワイトリスト。この中に入っているカラムは変更を許可させる
    protected $fillable = ['adominname','password'];
    protected $primaryKey='adomin_id';
    public $timestamps=false;

    //ルーム作成時にタイトルを格納する
    public function insert($adominname,$password){

        return Admin::create([
            'adominname'=>$adominname,
            'password'=>$password
        ]);
    }
}
