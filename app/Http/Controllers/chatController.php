<?php

namespace App\Http\Controllers;

use App\Models\Bystander;
use App\Models\Debater;
use App\Models\User;
use Illuminate\Http\Request;

class chatController extends Controller
{
    public function index($rid,$uid,$stateflag){

        //発表者DB操作インスタンス
        $debater = new Debater();
        //傍観者DB操作インスタンス
        $bystander = new Bystander();
        //傍観者と発表者を分けそれぞれを登録
        if($stateflag==1){
            $bystander->insert($rid,$uid);
        }else{
            $debater->insert($uid,$rid);
        }

        return view('chat',compact('rid','uid','stateflag'));
    }



    //傍観者にランダムに投票券を配布 引数:傍観者として投票したもの
    //現在は使用しないが今後使用する予定がある
    /*public function votingticket(Request $request,$bystander){

        //傍観者の中から最大の投票者数を決める
        //
        $bystandercoount=Bystander::where('r_id')->count();
        //$b=;
        foreach ($bystander as $item){

        }

        $session = $request->session()->all();
        //

        if ($request->session()->missing('ticket')) {
            //

        }

    }*/
}
