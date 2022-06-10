<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debater extends Model
{
    use HasFactory;
    protected $fillable = ["r_id","u_id"];
    protected $primaryKey = 'd_id' ;

}
