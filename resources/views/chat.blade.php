<?php

use Illuminate\Support\Facades\Auth;

?>
@extends('header')

@section('head')
    {{--タイマー--}}
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery.simple.timer.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/chat.css')}}">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>

    <input type="hidden" name="room_id" value="{{$rid=$roomdata->r_id}}">
    <script>
        $(function(){
            $('.timer').startTimer({
                onComplete:function(element){
                    //カウントダウン終了時にdiv class="timer"をcompleteへ変更する
                    element.addClass('complete');
                }
            });
        });
        //10秒後に指定したリンクへ飛ぶ
        setTimeout(function(){
            window.location.href = '{{url('/vote2',compact('rid'))}}';
        }, {{--$tim--}}*1000);
    </script>
@endsection
@section('body')
    <div class="container mt-5 shadow-lg">
        <div class="row shadow">
        <h1 class="text-center mt-5 mb-3">{{$roomdata->t_name}}</h1>
        @if($state==0)
            @if($usersposition="賛成")
                <p class="fs-2 text-center col-11">あなたは<span class="fs-1 text-danger">{{$usersposition}}派</span>です</p>
            @else
                <p class="fs-2 text-center col-11">あなたは<span class="fs-1 text-primary">{{$usersposition}}派</span>です</p>
            @endif
        @elseif($state==1)
            <p>あなたの立場は傍観者です</p>
        @endif
            {{--タイマー--}}
            <div class='timer text-danger fs-3 text-end col-1' data-seconds-left="{{--$tim--}}">10:00</div>
        </div>
        <div class="row  h-50 w-100 overflow-auto mt-4 mx-auto" id="chatzone">
            <div id="chat-data">
                {{-- チャット履歴を表示させる --}}
            </div>
        </div>
@if($state==0)
    {{---  チャット送信  ---}}
    {{--- web.phpの/chat ---}}
        <form action="{{url('/chat/'.$roomdata->r_id.'/'.$state)}}" method="post" id="chatform" class="mt-5">
            @csrf
            <input type="hidden" name="user_id" value="{{$id = auth()->id()}}">
            <input type="hidden" name="user_name" value="{{$name}}">
            <input id="room_id" type="hidden" name="room_id" value="{{$roomdata->r_id}}">
            <input type="hidden" name="users_position" value="{{$usersposition}}">
            <textarea
                id="message"
                type="text"
                max="500"
                required
                name="message"
                placeholder="メッセージを入力"
                class="form-control"></textarea>
            <input id="submit" type="submit" value="送信" class="btn btn-outline-primary btn-lg mt-3 mb-4">
        </form>
        </div>
    @yield('js')
    </div>
@else
    <input id="room_id" type="hidden" name="room_id" value="{{$roomdata->r_id}}">
    {{-- 傍観者の場合コチラが表示される --}}
@endif

@endsection
@section('js')
<script src="{{ asset('js/chat.js') }}"></script>
@endsection
