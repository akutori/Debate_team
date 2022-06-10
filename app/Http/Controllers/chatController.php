<?php

namespace App\Http\Controllers;

use App\Models\Bystander;
use App\Models\Debater;
use App\Models\User;
use Illuminate\Http\Request;

class chatController extends Controller
{
    public function index($rid){
        $roid = $rid;

        //発表者DB操作インスタンス
        $debater = new Debater();
        //傍観者DB操作インスタンス
        $bystander = new Bystander();


        //セッションによって賛成反対と
        // リクエストインスタンス経由
        //$request->session()->put('userposition', null);



        //発表者の賛成と反対をランダムに選択
        if(isset($positon)){
            random_int(0,1);

        }

        return view('chat',compact('rid'));
    }

    //発言者と傍観者を登録 引数:発言者として登録したもの,傍観者として登録したもの
    public function inputdebater($roomid,$debateuser,$bystander){
        $debater = new Debater();
        $debater->create([
            'r_id'=>$roomid,
            'u_id'=>$debateuser
        ]);
        $debater->save();

        $bystand = new Bystander();
        $bystand->create([
            'r_id'=>$roomid,
            'u_id'=>$bystander
        ]);
        $bystand->save();
    }
    //傍観者にランダムに投票券を配布 引数:傍観者として投票したもの
    public function votingticket(Request $request,$bystander){

        foreach ($bystander as $item){

        }

        $session = $request->session()->all();
        //

        if ($request->session()->missing('ticket')) {
            //

        }

    }
}
