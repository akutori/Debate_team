<?php

use Illuminate\Support\Facades\Auth;

?>
@extends('header')

@section('head')

@endsection
@section('body')
    <div class="title">
        <h1>Chat 予定地</h1>
        <p>{{$roomdata->t_name}}のchat</p>

        <div class="chat-container row justify-content-center">
    <div class="chat-area">
        <div class="card">
            <div class="card-header">Comment</div>
             {{-- チャット欄 --}}
    @foreach($chats as $chat)
    <span class="chat-body-id"></span>
    <span class="chat-body-user"></span>
    <span class="chat-body-time"></span>
    <span class="chat-body-message"></span>
    @endforeach
            <div class="card-body chat-card">
                <div id="chat-data"></div>
            </div>
        </div>
    </div>
</div>




        {{---  チャット送信  ---}}
                    {{--- web.phpの/chat ---}}
        <form action="{{url('/chat')}}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{$id = auth()->id()}}">
        <input type="hidden" name="user_name" value="{{$name}}">
        <input type="text" name="message">
        <input type="submit" value="送信">
        </form>
        </div>

    @yield('js')


@endsection
@section('js')
<script src="{{ asset('js/chat.js') }}"></script>
@endsection
