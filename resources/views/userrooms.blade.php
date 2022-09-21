@extends('header')

@section('head')
    <link href="https://fonts.googleapis.com/css2?family=Gentium+Plus:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/theme.css')}}">
    <link rel="stylesheet" href="{{asset('js/theme.js')}}">
@endsection
@section('body')
    <div id="particles-js"></div>
    <div id="wrapper">
        <div class="color">
            <div class="title">
                <h1>Choose Theme</h1>
                <h2>参加したいテーマを選択してください</h2>
                <input type="button" class="popb1" value="戻る" onclick="location.href='{{url('/sgenre')}}'">
            </div>

            <p class="titles">ユーザー作成</p>
            <div class="rooms">
                {{-- <p class="titles">ユーザー作成</p> ←この場所にあるとユーザーの後ろの「-」が改行される  --}}
                @foreach($room as $room_once)
                    <dialog id="dialog2{{$room_once->r_id}}" class="dialog_style" >
                        <div class="back2"></div>
                        <div class="nnn2">
                            <p class="p3">Choose Position</p>
                            <p class="p4">あなたの立場を選んでください</p>
                            <p class="p5">※傍観者の中からランダムに投票権が付与されます。</p>
                            <div class="under">
                                {{-- 部屋IDとユーザーIDは前の画面から取得して状態のみこちらから指定する --}}
                                <input type="button" class="popb1" onclick="location.href='{{url('/standby/'.$room_once->r_id.'/'.$debater_flag)}}'" value="発言者">
                                <input type="button" class="popb1" onclick="location.href='{{url('/standby/'.$room_once->r_id.'/'.$bystander_flag)}}'" value="傍観者">
                            </div>
                            <button class="popb1" onclick="document.getElementById('dialog2{{$room_once->t_id}}').close();">戻る</button>
                        </div>
                    </dialog>

                    <dialog id="dialog{{$room_once->t_id}}" class="dialog_style" >
                        <div class="back"></div>
                        <div class="nnn">
                            <p class="p1">参加しますか？</p>
                            <p class="p2">{{$room_once->t_name}}</p>
                            <div class="button1">
                                <button class="popb1" onclick="document.getElementById('dialog2{{$room_once->t_id}}').show();">参加する</button>
                                <button class="popb1" onclick="document.getElementById('dialog{{$room_once->t_id}}').close();">戻る</button>
                            </div>
                        </div>
                    </dialog>
                    {{-- ここに一覧を表示させる --}}
                    <div>{{$room_once->c_name}}<input type="button" class="cont" onclick="document.getElementById('dialog{{$room_once->t_id}}').show();" value="{{$room_once->t_name}}"></div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src={{asset('js/theme.js')}}></script>
@endsection
