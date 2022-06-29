<?php

use Illuminate\Support\Facades\Auth;

?>
@extends('header')

@section('head')

@endsection
@section('body')
    <div class="title">
        <h1>Chat 予定地</h1>
        <p>のchat</p>

        {{-- チャット欄 --}}
    @foreach($chats as $chat)
    <p1>{{$chat->created_at}}＠{{$chat->user_id}}:{{$name}}</p1>
    <br>{{$chat->message}}
    @endforeach


        {{---  チャット送信  ---}}
                    {{--- web.phpの/chat ---}}
        <form action="{{url('/chat')}}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{$id = auth()->id()}}">
        <input type="text" name="message">
        <input type="submit" value="送信">

    </div>

@endsection
