<?php


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
//ログインした後の画面。genreに飛ぶ
Route::get('/',[GenreController::class,'index']);

//チャット機能
Route::post('/3reedman3/public/check/chat/{rid}/{state}',[ChatController::class,'store'])->name('chat');

//ディベートのジャンル選択ページ
Route::get('/sgenre',[GenreController::class,'index']);

Route::get('/stheme/{id}',[ThemeController::class,'index']);

Route::get('/3reedman3/public/check/chat/{rid}/{state}',[ChatController::class,'index']);

Auth::routes();

//laravel のホーム画面
Route::get('/home', [HomeController::class, 'index'])->name('home');

//getData
Route::get('/result/ajax/', [ChatController::class,'getData']);
Route::get('/3reedman3/public/check/chat/{rid}/result/ajax/',[ChatController::class,'getData']);

//待機画面ルート
Route::get('standby/{rid}/{state}',[RoomController::class,'waituser']);
//規定人数がいるかどうかを聞く
//デプロイ用ルート
Route::get('/3reedman3/public/check/{rid}/{state}',[RoomController::class,'confirmation']);
Route::get('/check/{rid}/{state}',[RoomController::class,'confirmation']);

//投票機能
Route::get('/vote2/{rid}',[\App\Http\Controllers\vote2Controller::class,'index']);
Route::get('/vote3',[\App\Http\Controllers\voteController::class,'index']);
Route::get('/voteko',[\App\Http\Controllers\votesumController::class,'ko']);
Route::get('/votesan',[\App\Http\Controllers\votesumController::class,'san']);
Route::get('/vote',[\App\Http\Controllers\votesumController::class,'index']);
