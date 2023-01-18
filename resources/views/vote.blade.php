<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/vote.js')}}"></script>
    <title>{{config('app.name')}}</title>
</head>
<body style="background-color: #cfcfcf;">
<div class="container-fluid bg-light shadow-lg w-75 mt-5" style="margin-top: 5.5em !important;">
    <div class="row">
        <h1 class="text-center mt-5 p-4" id="votetitle">投票中</h1>
    </div>
    <div class="row">
        @if($debater_flag==null)
            <p class="text-center fs-3">納得した方に投票してください</p>
        @else
            <p class="text-center fs-3">傍観者が投票中です</p>
        @endif
    </div>
    @if($debater_flag==null)
        <form action="{{url('/vote/sum')}}" method="post">
            @csrf
            <div class="row my-5">
                <input type="hidden" value="{{$roomid}}" id="roomid" name="roomid">
                <div class="col-2"></div>
                <div class="col-lg-3 mb-lg-0 mb-2">
                    <button type="submit" id="good" onclick="voteFunction(event)" value="1" class="btn btn-secondary btn-outline-danger text-white shadow-lg fs-1 p-5 form-control">賛成</button>
                </div>
                <div class="col-2"></div>
                <div class="col-lg-3 mt-lg-0 mt-5">
                    <div class="text-end">
                        <button type="submit" id="bad" onclick="voteFunction(event)" value="0" class="btn btn-secondary btn-outline-primary text-white shadow-lg fs-1 p-5 form-control">反対</button>
                    </div>
                </div>
                <span id="votedwaitmessage" class="text-center fs-2 p-4"></span>
                <span id="votedmessage" class="text-center fs-4 p-lg-5"></span>
                <div class="col-2"></div>
            </div>
        </form>
    @elseif($debater_flag==1)
        <input type="hidden" value="{{$roomid}}" id="roomid" name="roomid">
        <div class="row my-5">
            <div class="col-2"></div>
            <div class="col-3">

            </div>
            <div class="col-2"></div>
            <div class="col-3">

            </div>
            <span id="votewaitmessage" class="text-center fs-2 p-4">Please Wait . . .</span>
            <span id="votedmessage" class="text-center fs-4 p-5">何もせずにお待ち下さい</span>
            <div class="col-2"></div>
        </div>
    @endif
    <div class="row fs-1">
        <p id="timer" class="text-center fs-1 mb-5">残り19秒</p>
    </div>
</div>

</body>
</html>

