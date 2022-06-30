<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    //編集可能なカラム
    protected $fillable = ['c_id','c_name'];
    protected $primaryKey='c_id';
    public $timestamps = false;


}
