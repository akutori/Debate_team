<?php

use Illuminate\Support\Facades\Auth;

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <title>{{config('app.name')}}</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/jquery.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/chat.css')}}">
</head>
<body id="background">
<input type="hidden" id="starttime" value="{{$StartTime}}">
    <div class="container mt-3 shadow-lg bg-light">
        <div class="row shadow">
        <h1 class="text-center mt-5 mb-3">{{$roomdata->t_name}}</h1>
        <div class="col-2"></div>
        @if($state==0)
            @if($usersposition=="賛成")
                <p class="fs-2 text-center col-8">あなたは<span class="fs-1 text-danger">{{$usersposition}}派</span>です</p>
            @elseif($usersposition=="反対")
                <p class="fs-2 text-center col-8">あなたは<span class="fs-1 text-primary">{{$usersposition}}派</span>です</p>
            @endif
        @elseif($state==1)
            <p class="fs-2 text-center col-8">あなたは<span class="fs-1 text-success">傍観者</span>です</p>
        @endif
            {{--タイマー--}}
            <div class="col-auto col-lg-2 justify-content-start">
                <span class='timer text-danger fs-3' id="timer"></span>
            </div>
        </div>
        <div class="row overflow-auto mt-4 mx-auto" id="chatzone">
            <div id="chat-data">
                {{-- チャット履歴を表示させる --}}
            </div>
        </div>
        {{-- modal_start --}}
        <!-- 切り替えボタンの設定 -->
        <div class="container">
            <div class="row">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#lockalert" id="openmodal">
                    ココを押すとアラートによるチャットのロックデモを表示
                </button>
            </div>
        </div>
        <!-- モーダルの設定 -->
        <div class="modal fade" id="lockalert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-danger">
                    <div class="modal-header text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-exclamation-octagon-fill" viewBox="0 0 16 16">
                            <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        <h1 class="modal-title fs-2 ps-3" id="staticBackdropLabel">攻撃的なコメントを検知しました!!</h1>
                    </div>
                    <div class="modal-body">
                        <p class="fs-1 text-light">警告</p>
                        <p class="text-light fs-4">10秒間コメントをロックします</p>
                    </div>
                    <div class="modal-footer">
                        <div class="mx-auto d-block">
                            <button type="button" class="btn btn-warning btn-lg" data-bs-dismiss="modal" id="modalbutton">閉じる</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal_end --}}
    @if($state==0)
        {{---  チャット送信  ---}}
        {{--- web.phpの/chat ---}}
            <form action="{{url('/chat/'.$roomdata->r_id.'/'.$state)}}" method="post" id="chatform" class="mt-3">
                <div class="row shadow-lg">
                @csrf
                <input type="hidden" name="user_id" value="{{$id = auth()->id()}}">
                <input type="hidden" name="user_name" value="{{$name}}">
                <input id="room_id" type="hidden" name="room_id" value="{{$roomdata->r_id}}">
                <input type="hidden" name="users_position" value="{{$usersposition}}">
                <div class="col-1"></div>
                <div class="col-10 col-md-8">
                <input
                    id="message"
                    type="text"
                    max="500"
                    required
                    name="message"
                    placeholder="メッセージを入力"
                    autocomplete="off"
                    class="form-control py-4 py-md-3">
                </div>
                <div class="col-12 col-md-2 py-3 py-md-0">
                    <button type="submit" id="submit" class="btn btn-primary btn-lg mb-1 form-control py-4 py-md-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                        </svg>
                    </button>
                </div>
                <div class="col-md-1"></div>
                </div>
            </form>

    @else
        <input id="room_id" type="hidden" name="room_id" value="{{$roomdata->r_id}}">
        {{-- 傍観者の場合コチラが表示される --}}
    @endif
        <script src="{{ asset('js/chat.js') }}"></script>
    </div>
</body>
</html>
