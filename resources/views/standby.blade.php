@extends('header')

@section('head')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
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

        <button id="backinfo" type="button" onclick="document.getElementById('alert-info').show();">戻る</button>
        <dialog id="alert-info">
            <div class="fs-3 m-5 text-center">戻ろうとしています!</div>
            <button type="button" class="btn btn-outline-primary btn-lg mx-3" onclick="document.getElementById('alert-info').close();">待機画面に戻る</button>
            <button type="button" class="btn btn-outline-warning btn-lg mx-3" onclick="location.href='{{url('/stheme/'.$roomid.'/'.$state.'/'.$userid)}}'">待機室から抜ける</button>
            <button type="button" class="btn btn-outline-warning btn-lg mx-3" onclick="location.href='{{url('/sgenre/'.$roomid.'/'.$state.'/'.$userid)}}'">ジャンル選択に戻る</button>
        </dialog>

@endsection
@section('js')
    <script src="{{ asset('js/standby.js') }}"></script>
@endsection
