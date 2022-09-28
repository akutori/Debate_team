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
            <div class="row">
            @csrf
            <input type="hidden" name="user_id" value="{{$id = auth()->id()}}">
            <input type="hidden" name="user_name" value="{{$name}}">
            <input id="room_id" type="hidden" name="room_id" value="{{$roomdata->r_id}}">
            <input type="hidden" name="users_position" value="{{$usersposition}}">
            <div class="col-9">
            <input
                id="message"
                type="text"
                max="500"
                required
                name="message"
                placeholder="メッセージを入力"
                class="form-control py-3">
            </div>
            <div class="col-2">
                <button type="submit" id="submit" class="btn btn-primary btn-lg mb-4 form-control py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                    </svg>
                </button>
            </div>
            </div>
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
