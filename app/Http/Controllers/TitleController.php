<?php

namespace App\Http\Controllers;

use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TitleController extends Controller
{
    // お題作成ページを表示
    public function index(){
        $categoryList = DB::table('categories')->get();
        return view('addTitle',compact('categoryList'));
    }

    // お題作成ページの「登録ボタン」を押下したとき
    public function titleInsert(Request $request){
        $form = $request->only(['title','category']);
        $titles = new Title();
        $titles->insert($form['title'],$form['category']);
        return view('rootpage');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function show(Title $title)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function edit(Title $title)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Title $title)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function destroy(Title $title)
    {
        //
    }
}
