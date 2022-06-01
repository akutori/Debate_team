@extends('header')

@section('head')
    <link rel="stylesheet" href="{{asset('css/genre.css')}}">
@endsection
@section('body')
    <div class="title">
        <h1>Choose Genre</h1>
        <h2>参加したいジャンルを選択してください</h2>
    </div>

    <div class="genres">
        @for($i=0;$i<$val;$i++)
            <a href="{{url('/stheme',compact('i'))}}" ><img class="genreimg" src="{{asset('images/ima.jpg')}}"></a>
        @endfor
    </div>
    <!--
    <div class="test">
        <p><a href="{{url('/theme')}}">ジャンルに戻る</a> </p>
    </div>
    -->

@endsection