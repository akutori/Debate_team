<?php

use Illuminate\Support\Facades\Route;
use Illuminate\http\Request;

/*
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
*/
Route::get('/chat',function (){
    return view('chat');
});

Route::get('/sgenre',[\App\Http\Controllers\genreController::class,'index']);

Route::get('/stheme/{id}',[\App\Http\Controllers\themeController::class,'index']);
