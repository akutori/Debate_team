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
}
