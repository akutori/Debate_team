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
    {{--タイマー--}}
    <div class='timer' data-seconds-left="{{--$tim--}}"></div>
    <div class="">
        <h1>{{$roomdata->t_name}}のchat</h1>
        @if($state==0)
            @if($usersposition="賛成")
                <p class="bg-denger">あなたは{{$usersposition}}派です</p>
            @else
                <p class="bg-info">あなたは{{$usersposition}}派です</p>
            @endif
        @elseif($state==1)
            <p>あなたの立場は傍観者です</p>
        @endif
        <div id="chat-data">
            {{-- チャット履歴を表示させる --}}
        </div>
    </div>
@if($state==0)
    {{---  チャット送信  ---}}
    {{--- web.phpの/chat ---}}
        <form action="{{url('/chat/'.$roomdata->r_id.'/'.$state)}}" method="post" id="chatform" class="">
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
            <input id="submit" type="submit" value="送信" class="btn btn-outline-primary btn-lg">
        </form>
        </div>
    @yield('js')
@else
    <input id="room_id" type="hidden" name="room_id" value="{{$roomdata->r_id}}">
    {{-- 傍観者の場合コチラが表示される --}}
@endif

@endsection
@section('js')
<script src="{{ asset('js/chat.js') }}"></script>
@endsection
