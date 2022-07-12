<?php

use Illuminate\Support\Facades\Auth;

?>
@extends('test')
<link rel="stylesheet" href="{{asset('css/chat.css')}}">
<link rel="stylesheet" href="{{asset('js/genre.js')}}">
<div id="particles-js"></div>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css"
      integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu"
      crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
      crossorigin="anonymous">
@section('head')

@endsection
@section('body')
    <div id="wrapper">
    <div class="all">

            <h1>Chat</h1>
            <p>{{$roomdata->t_name}}のchat</p>
        <div class="container">

            <div class="chat bg-light p-4">
                <div class="message d-flex flex-row align-items-start mb-4">



                    <div class="card-body chat-card">
                        <div id="chat-data"></div>
                        <span class="chat-body-id"></span>
                        <span class="chat-body-user"></span>
                        <span class="chat-body-time"></span>
                        <span class="chat-body-message"></span>
                    </div>

                </div><!-- .message -->
        </div>
        </div>




                        {{-- チャット欄 --}}



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
