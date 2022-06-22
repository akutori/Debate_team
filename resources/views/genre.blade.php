@extends('header')

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gentium+Plus:ital@1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">　
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/genre.css')}}">
@endsection
@section('body')


        <div class="title">
            <h1>Choose Genre</h1>
            <h2>参加したいジャンルを選択してください</h2>
        </div>

        <div class="genres">
            @foreach($cate as $category)
                <a href="{{url('/stheme',compact($category->c_id))}}"><img class="genreimg" src="{{asset('images/ima.jpg')}}"></a>
            @endforeach
        </div>




    <!--
    <div class="test">
        <p><a href="{{url('/theme')}}">ジャンルに戻る</a> </p>
    </div>
    -->

@endsection
