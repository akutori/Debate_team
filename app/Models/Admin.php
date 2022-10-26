<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    use HasFactory;

    //ホワイトリスト。この中に入っているカラムは変更を許可させる
    protected $fillable = ['adominname','password'];
    protected $primaryKey='adomin_id';
    public $timestamps=false;

    //ルーム作成時にタイトルを格納する
    public function insert($adminname, $password){

        return Admin::create([
            'adominname'=>$adminname,
            'password'=>$password
        ]);
    }

    // adminsテーブルに登録されているか確認
    public function adminCheck($adminname, $password){
        $adminAcount = Admin::where( 'adominname', '=', $adminname )->first();
        // パスワードが一致した場合は、結果を返す。ない場合は、nullを返す
        if( !($adminAcount == null) && password_verify($password, $adminAcount->password) ){
                return $adminAcount;
        } else {
            return null;
        }
    }
}
