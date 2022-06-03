<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    //ホワイトリスト。この中に入っているカラムは変更を許可させる
    protected $fillable = ['t_name'];
    //ブラックリスト。この中に入っているカラムは変更や作成ができない
    protected $guarded = ['t_id'];
}
