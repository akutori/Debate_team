<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class genreController extends Controller
{
    public function index(){
        ;
        return view('genre',compact('cate'));
    }

}
