<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ng extends Model
{
    use HasFactory;
    protected $fillable = ["n_words"];

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
}
