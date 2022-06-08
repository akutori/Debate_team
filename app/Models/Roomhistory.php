<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roomhistory extends Model
{
    use HasFactory;
    protected $fillable = ["t_id","r_id","rh_day","rh_sum","rh_win"];
}
