<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <script src="{{asset('js/jquery.js')}}"></script>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/standby.css')}}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/standby.js')}}"></script>
    <title>{{config('app.name')}}</title>
</head>
<body id="background">
<input type="hidden" name="roomid" id="roomid" value="{{$roomid}}">
<input type="hidden" name="state" id="state" value="{{$state}}">

<div class="container mt-5 shadow-lg text-cente w-50 bg-light">
    <div class="row pt-5 pb-4">
        <div class="col-1"></div>
        <div class="col-12 col-md-10 text-center">
            <span class="fs-1">{{$roomtitle->t_name}}</span>
        </div>
        <div class="col-1"></div>
    </div>
    <div class="row pb-4">
        <div class="col-3"></div>
        <div class="col-12 col-md-6 text-center">
            @if($state==0)
                @if(isset($debaterstate)&&$debaterstate==0)
                    <span class="fs-5">あなたは<span class="fs-4 text-danger">賛成</span>です</span>
                @elseif(isset($debaterstate)&&$debaterstate==1)
                    <span class="fs-5">あなたは<span class="fs-4 text-primary">反対</span>です</span>
                @endif
            @elseif($state==1)
                あなたは<span class="fs-4 text-success">傍観者</span>です
            @endif
        </div>
        <div class="col-3"></div>
    </div>
    <div class="row pb-4">
        <div class="col-4"></div>
        <div class="col-12 col-md-4 text-center">
            <div class="fs-5">現在の待機数:<span class="fs-3 text-danger" id="participants"></span>人</div>
        </div>
        <div class="col-4"></div>
    </div>
    <div class="row pb-4">
        <div class="col-5"></div>
        <div class="col-12 col-md-02 text-center">
            <button class="btn btn-outline-primary shadow" data-bs-toggle="modal" data-bs-target="#exitModal">退出する</button>
        </div>
        <div class="col-5"></div>
    </div>
    <div class="row pb-4">
        <div class="col-3"></div>
        <div class="col-12 col-md-6 text-center">
            <span class="fs-2" id="dot">Please wait . . .</span>
        </div>
        <div class="col-3"></div>
    </div>
    <div class="row pt-4 pb-5">
        <div class="col-2"></div>
        <div class="col-12 col-md-8 text-center">
            <p class="fs-6">あなたと反対の立場と傍観者を<br>含めた合計三人に達すると開始されます</p>
        </div>
        <div class="col-2"></div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exitModal" tabindex="-1" aria-labelledby="exitModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exitModalLabel">退出しようとしています!!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                退出しますか?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="location.href='{{url('/stheme/'.$roomid.'/'.$state.'/'.$userid)}}'">部屋から退出</button>
                <button type="button" class="btn btn-secondary" onclick="location.href='{{url('/sgenre/'.$roomid.'/'.$state.'/'.$userid)}}'">退出してジャンルに戻る</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">戻る</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
