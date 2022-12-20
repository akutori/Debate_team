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
       \DB::table('ngs')->insert(['n_words' => $n_words]);
       $ng->save();
    }


    //送信した文章にNGワードが含まれていた場合そのワード置き換える
    public function replace_word($word): array|string
    {
        $ngwords = Ng::select('n_words')->get()->toArray();
        foreach ($ngwords as $ngword){
            //そのワードの中にNGワードが含まれていた場合はその文字を置き換える
            $pos = mb_strpos($word,$ngword['n_words']);
            //文字列がNGワードを含んでいた場合、ワードを検閲して文字列を返す
            if($pos !== false){
                return str_replace($ngword['n_words'],"🤬🤬🤬",$word);
            }
        }
        //NGワードに引っかからなかった場合は普通に元に戻す
        return $word;
    }

    public function deletes($n_id){
        Ng::where("n_id", $n_id) -> delete();
    }
}
