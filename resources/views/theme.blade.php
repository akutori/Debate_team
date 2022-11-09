@extends('header')

@section('head')
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <script src="{{asset('/js/app.js')}}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Gentium+Plus:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@300&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{asset('css/theme.css')}}">-->
    <link rel="stylesheet" href="{{asset('js/theme.js')}}">

@endsection
@section('body')
    <div id="particles-js"></div>
    <div id="wrapper">
        <div class="container">
            <div class="fs-1 text-center">
                <h1>Choose Theme</h1>
                <h2>参加したいテーマを選択してください</h2>
            </div>
            <div class="text-center">
                <input type="button" class="  btn btn-outline-info btn-secondary border-secondary text-white "
                       value="戻る" onclick="location.href='{{url('/sgenre')}}'">
            </div>


            <div class="col text-center">
                <div class="fs-2" id="titles">
                    <p class="test">{{-- $room->r_id --}}</p>
                    <p class="titles">{{$category->title_id}}{{$category->c_name}}</p>
                </div>

            </div>

        </div>
        @foreach($room as $room_once)
            <input type="button" class="w-75 mt-2" data-bs-toggle="modal" data-bs-target="#dialog{{$room_once->t_id}}"
                   id="theme_btn" onclick="document.getElementById('dialog{{$room_once->t_id}}').show();"
                   value="{{$room_once->t_name}}">


            <!-- Modal -->
            <div class="modal fade" id="dialog{{$room_once->t_id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="p1" id="exampleModalLabel">参加しますか？</p>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="p2">{{$room_once->t_name}}</p>
                        </div>
                        <div class="modal-footer">
                            <button class="popb1" data-bs-target="#dialog2{{$room_once->t_id}}"
                                    onclick="document.getElementById('dialog2{{$room_once->t_id}}').show();">参加する
                            </button>
                            <button class="" data-bs-dismiss="modal">戻る</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="dialog2{{$room_once->t_id}}" tabindex="-1" aria-labelledby="exampleModalLabels"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="p1" id="exampleModalLabels">Choose Position</p>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="p3">Choose Position</p>
                            <p class="p4">あなたの立場を選んでください</p>
                            <p class="p5">※傍観者の中からランダムに投票権が付与されます。</p>
                        </div>
                        <div class="modal-footer">
                            {{-- 部屋IDとユーザーIDは前の画面から取得して状態のみこちらから指定する --}}
                            <input type="button" class="popb1"
                                   onclick="location.href='{{url('/standby/'.$room_once->r_id.'/'.$debater_flag)}}'"
                                   value="発言者">
                            <input type="button" class="popb1"
                                   onclick="location.href='{{url('/standby/'.$room_once->r_id.'/'.$bystander_flag)}}'"
                                   value="傍観者">
                        </div>
                    </div>
                </div>
            </div>
            {{-- ここに一覧を表示させる --}}

        <!-- <div id="dialog2{{$room_once->r_id}}" class="modal-dialog "  >
                        <div class="modal-body">
                            <p class="p3">Choose Position</p>
                            <p class="p4">あなたの立場を選んでください</p>
                            <p class="p5">※傍観者の中からランダムに投票権が付与されます。</p>
                        </div>
                        <div class="modal-footer">
                                {{-- 部屋IDとユーザーIDは前の画面から取得して状態のみこちらから指定する --}}
            <input type="button" class="popb1" onclick="location.href='{{url('/standby/'.$room_once->r_id.'/'.$debater_flag)}}'" value="発言者">
                                <input type="button" class="popb1" onclick="location.href='{{url('/standby/'.$room_once->r_id.'/'.$bystander_flag)}}'" value="傍観者">
                        </div>

                            <button class="popb1" onclick="document.getElementById('dialog2{{$room_once->t_id}}').close();">戻る</button>-->

            <!-- <form action="" method="post">
                <button class="popb2" type="submit" name="out" value="1">はい</button>
            </form> -->





        @endforeach

    </div>
    </div>
    </div>
    <!-- <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src={{asset('js/theme.js')}}></script>-->
@endsection
