@extends('header')

@section('head')
@endsection
@section('body')
    <input type="hidden" name="roomid" id="roomid" value="{{$roomid}}">
    <input type="hidden" name="state" id="state" value="{{$state}}">
    <input type="hidden" name="userid" id="userid" value="{{$userid}}">
    <div id="state-data">
        <div class="message"></div>
        <div class="debater"></div>
        <div class="bystander"></div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/standby.js') }}"></script>
@endsection
