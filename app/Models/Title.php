<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    //ホワイトリスト。この中に入っているカラムは変更を許可させる
    protected $fillable = ['t_name'];
    protected $primaryKey='t_id';
    public $timestamps = false;

    //ルーム作成時にタイトルを格納する
    public function insert($title,$cateid){

        return Title::create([
            't_name'=>$title,
            'category_id'=>$cateid
        ]);
    }
    //一番最後に入れたデータを取得
    public function getLastTitleData(){
        return Title::latest('t_id')->first();
    }
}
