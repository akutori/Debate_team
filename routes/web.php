<?php


use App\Http\Controllers\allController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use Illuminate\http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\GenreController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;


/*;
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/theme/{id}',function ($id){
    return view('theme',compact('id'));
});
Route::get('/genre',function (){
    return view('genre');
});

Route::get('/chat',function (){
    return view('chat');
});
*/

//チャット機能
Route::post('/chat/{rid}/{state}',[ChatController::class,'store'])->name('chat');

//ディベートのジャンル選択ページ
Route::get('/sgenre',[GenreController::class,'index']);

Route::get('/makeroom',[RoomController::class,'index']);

Route::get('/stheme/{id}',[ThemeController::class,'index']);
//待機室から抜ける(部屋から離脱する)
Route::get('/stheme/{roomid}/{state}/{userid}',[ThemeController::class,'exit_from_waiting_room'])->name('exitwaitroom');

Route::get('/chat/{rid}/{state}',[ChatController::class,'index']);



//laravel のホーム画面
Route::get('/home', [HomeController::class, 'index'])->name('home');

//getData
Route::get('/chat/{rid}/result/ajax',[ChatController::class,'getData']);
Route::get('/result/ajax/', [ChatController::class,'getData']);

//待機画面ルート
Route::get('standby/{rid}/{state}',[RoomController::class,'waituser']);
//規定人数がいるかどうかを聞く
//デプロイ用ルート
//Route::get('/check/{rid}/{state}',[RoomController::class,'confirmation']);
Route::get('/check/{rid}/{state}',[RoomController::class,'confirmation']);

//投票機能
Route::get('/vote2/{rid}',[\App\Http\Controllers\vote2Controller::class,'index']);
Route::get('/vote3/{rid}',[\App\Http\Controllers\voteController::class,'index']);
Route::get('/voteko/{rid}',[\App\Http\Controllers\votesumController::class,'ko']);
Route::get('/votesan/{rid}',[\App\Http\Controllers\votesumController::class,'san']);
Route::get('/vote/{rid}',[\App\Http\Controllers\votesumController::class,'index']);

//all機能
Route::get('/all',[allController::class,'index']);

//mypage機能
Route::get('/mypage',[\App\Http\Controllers\MypageController::class,'index']);
Route::get('/readme',[GenreController::class,'readme']);
Route::get('/ranking',[\App\Http\Controllers\RankingController::class,'index']);
Route::get('/delroom',[\App\Http\Controllers\DelController::class,'index']);

//ルート変更(改訂版）
//一番最初にreadmeページを開く
Route::get('/',[GenreController::class,'readme']);
//ログインボタンを押下
Auth::routes();

//管理者画面に遷移
Route::get('/root',function(){
     return view('rootpage');
});
// 管理者画面の「NGワード編集」ボタンを押下したとき
Route::get('/ngwordEdit',[\App\Http\Controllers\NgwordController::class,'index']);

// 管理者画面の「お題作成」ボタンを押下したとき
Route::get('/addTitle',[\App\Http\Controllers\TitleController::class,'index']);
// お題作成ページの「登録ボタンを押下したとき
Route::post('/titleInsert',[\App\Http\Controllers\TitleController::class,'titleInsert']);

// 管理者画面の「ルーム一覧」ボタンを押下したとき
Route::get('/roomAll',[\App\Http\Controllers\RoomAllController::class,'index']);
// 管理者画面の「チャット時間の編集」ボタンを押下したとき
Route::get('/timeChange',[\App\Http\Controllers\TimeChangeController::class,'index']);



