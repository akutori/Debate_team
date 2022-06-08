<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ng extends Model
{
    use HasFactory;
    protected $fillable = ["n_words"];
}
