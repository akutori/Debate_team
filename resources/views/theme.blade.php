@extends('header')

@section('head')
    <link rel="stylesheet" href="{{asset('css/theme.css')}}">
@endsection
@section('body')
    <div class="color">
        <div class="title">
            <h1>Choose Theme</h1>
            <h2>参加したいテーマを選択してください</h2>
            <input type="button" class="popb1" value="戻る" onclick="location.href='{{url('/sgenre')}}'">
        </div>

        <div class="rooms">
            <p class="test">{{-- $room->r_id --}}</p>
            @foreach($room as $room_once)

                <dialog id="dialog2{{$room_once->r_id}}" class="dialog_style" >
                    <div class="back2"></div>
                    <div class="nnn2">
                        <p class="p3">Choose Position</p>
                        <p class="p4">あなたの立場を選んでください</p>
                        <p class="p5">※傍観者の中からランダムに投票権が付与されます。</p>
                        <div class="under">
                            {{-- 部屋IDとユーザーIDは前の画面から取得して状態のみこちらから指定する --}}
                        <input type="button" class="popb1" onclick="location.href='{{url('/schat/'.$room_once->r_id,compact($room_once->r_id,$userid,0))}}'" value="発言者">
                        <input type="button" class="popb1" onclick="location.href='{{url('/schat/'.$room_once->r_id,compact($room_once->r_id,$userid,1))}}'" value="傍観者">
                        </div>

                        <button class="popb1" onclick="document.getElementById('dialog2{{$room_once->title_id}}').close();">戻る</button>
                    </div>
                </dialog>

                <dialog id="dialog{{$room_once->title_id}}" class="dialog_style" >
                    <div class="back"></div>
                    <div class="nnn">
                        <p class="p1">参加しますか？</p>
                        <p class="p2">{{$room_once->t_name}}</p>
                        <div class="button1">
                        <button class="popb1" onclick="document.getElementById('dialog2{{$room_once->title_id}}').show();">参加する</button>
                        <button class="popb1" onclick="document.getElementById('dialog{{$room_once->title_id}}').close();">戻る</button>
                        </div>
                    </div>
                </dialog>
                {{-- ここに一覧を表示させる --}}
                <p class="titles">{{$room_once->category_id}}:{{$room_once->c_name}}</p>
                <p class="day">{{$room_once->r_day}}</p>
                <input type="button" class="cont" onclick="document.getElementById('dialog{{$room_once->title_id}}').show();" value="{{$room_once->t_name}}">

            @endforeach
        </div>
    </div>
@endsection
