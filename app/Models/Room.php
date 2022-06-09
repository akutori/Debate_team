<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    //テーブル名
    protected $table = 'room';
    //主キー
    //protected $primaryKey = 'r_id';
    //変更を許可されたカラム
    protected $fillable = ['','','',''];
}
