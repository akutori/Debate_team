@extends('header')

@section('head')
    <link rel="stylesheet" href="{{asset('css/theme.css')}}">
@endsection
@section('body')
    <div class="title">
        <h1>Choose Theme</h1>
        <h2>参加したいテーマを選択してください</h2>
    </div>
    <div class="rooms">
        <p class="test">{{$iid}}</p>
        @for($i=0;$i<$rooms;$i++)
            <a href="{{url('/chat')}}" ><p class="titles">{{$title}}</p></a>
            <p class="day">{{$day}}</p>
            <a href="{{url('/chat')}}" ><p class="cont">{{$cont}}</p></a>
        @endfor
    </div>
@endsection
