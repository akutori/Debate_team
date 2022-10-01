<?php

namespace App\Http\Controllers;


use App\Models\Bystander;
use App\Models\Category;
use App\Models\Debater;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GenreController extends Controller
{
    public function index(){
        $cate = Category::all();
        $ctn = 0;
        return view('genre', compact('cate', 'ctn'));
    }

    public function exit_from_waiting_room($roomid, $state, $userid){
        $debater = new Debater();
        $bystander = new Bystander();
        switch ($state) {
            case 0:
                $debater->remove_debater_by_id($userid, $roomid);
                break;
            case 1:
                $bystander->remove_bystander_by_id($userid, $roomid);
                break;
        }

        $cate = Category::all();
        $ctn = 0;
        return view('genre', compact('cate', 'ctn'));
    }

    public function readme()
    {
        return view('readme');
    }
}
