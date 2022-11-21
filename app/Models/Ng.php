<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ng extends Model
{
    use HasFactory;
    protected $fillable = ["n_words"];
    protected $primaryKey='n_id';
    public $timestamps = false;

    // ngテーブルの全件取得
    public function ngList(){
        return DB::table("ngs")->get();
    }

    // ngテーブルにキーワードを新規登録
    public function ngwordInsert($n_words){
        $ng = new NG();
        $ng->n_id = null;
        $ng->n_words = $n_words;
       //\DB::table('ngs')->insert(['n_words' => $n_words]);
       $ng->save();
    }
}
