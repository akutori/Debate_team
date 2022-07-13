<?php

use Illuminate\Support\Facades\Auth;

?>
@extends('header')

@section('head')
    {{--タイマー--}}
    <p>{{$stflg->timestartflg}}</p>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery.simple.timer.js')}}"></script>

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
        }, {{$tim}}*1000);
    </script>
@endsection
@section('body')
    {{--タイマー--}}
    <div class='timer' data-seconds-left="{{$tim}}"></div>

    <div class="title">
        <h1>Chat 予定地</h1>
        <p>{{$roomdata->t_name}}のchat</p>


        <div class="chat-container row justify-content-center">
    <div class="chat-area">
        <div class="card">
            <div class="card-header">Comment</div>
             {{-- チャット欄 --}}

                <span class="chat-body-id"></span>
                <span class="chat-body-user"></span>
                <span class="chat-body-time"></span>
                <span class="chat-body-message"></span>

            <div class="card-body chat-card">
                <div id="chat-data"></div>
            </div>
        </div>
    </div>
</div>


@if($state==0)

    {{---  チャット送信  ---}}
    {{--- web.phpの/chat ---}}

        <form action="{{url('/chat/'.$roomdata->r_id.'/'.$state)}}" method="post">

        @csrf
        <input type="hidden" name="user_id" value="{{$id = auth()->id()}}">
        <input type="hidden" name="user_name" value="{{$name}}">
        <input id="room_id" type="hidden" name="room_id" value="{{$roomdata->r_id}}">
        <input type="text" name="message">
        <input type="submit" value="送信">
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
