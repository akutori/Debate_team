@extends('header')

@section('head')
@endsection
@section('body')
    <input type="hidden" name="roomid" id="roomid" value="{{$roomid}}">
    <input type="hidden" name="state" id="state" value="{{$state}}">
    <input type="hidden" name="userid" id="userid" value="{{$userid}}">
    <h1>{{$roomtitle->t_name}}</h1>
    @if($state==0)
        <h2>あなたの立場は「発表者」:{{$debaterstate}}側で討論してください</h2>
    @elseif($state==1)
        <h2>あなたの立場は「傍観者」です</h2>
    @endif
    <div id="state-data">
        <div class="message"></div>
        <div class="debater"></div>
        <div class="bystander"></div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/standby.js') }}"></script>
@endsection
