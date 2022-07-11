<?php

use Illuminate\Support\Facades\Auth;

?>
@extends('test')
<link rel="stylesheet" href="{{asset('css/chat.css')}}">
<link rel="stylesheet" href="{{asset('js/genre.js')}}">
<div id="particles-js"></div>
@section('head')

@endsection
@section('body')
    <div id="wrapper">

        <div class="title">
        <h1>Chat</h1>


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
    </div>
    </div>

@if($state==0)

    {{---  チャット送信  ---}}
    {{--- web.phpの/chat ---}}

        <form action="{{url('/chat/'.$roomdata->r_id.'/'.$state)}}" method="post">

        @csrf
        <input type="hidden" name="user_id" value="{{$id = auth()->id()}}">
        <input type="hidden" name="user_name" value="{{$name}}">
        <input type="hidden" name="room_id" value="{{$roomdata->r_id}}">
        <input type="text" name="message">
        <input type="submit" value="送信">
        </form>
        </div>

    @yield('js')
@endif

    {{-- 傍観者の場合コチラが表示される --}}

@endsection
@section('js')
<script src="{{ asset('js/chat.js') }}"></script>
<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src={{asset('js/genre.js')}}></script>
@endsection
