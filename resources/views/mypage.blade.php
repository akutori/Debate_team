<html>
<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
<body>
<div class="grid text-center">
    <a href="{{url('/sgenre')}}" ><img class="w-50 h-50" src="{{asset('images/debate01.png')}}"></a>
</div>
    <h1 class="text-success text-center">Mypage</h1>

    <p class="text-center text-muted mt-2">
        <span class="font-monospace">
            {{$username}}さん
        </span>
        <span class="text-black p-2">
            {{$userpoint}}ポイント
        </span>
        <a class="btn btn-link" href="{{ url('root') }}">
            {{ __('管理者の方はこちら') }}
        </a>
    </p>

    <div class="row row-cols-1 row-cols-lg-2 justify-content-center">
        <div class="card m-2" style="width: 15rem;">
            <a href="{{ url('/sgenre') }}" class="delay-time fadeUp ">
                <img class="card-img-top p-2 rounded-circle" src="{{asset('./images/口論余白改良形.png')}}">
            </a>
            <button type="button" class="btn rounded-pill btn-primary mb-2" onclick="location.href='{{url('/sgenre')}}'">ディベート</button>
        </div>
        <div class="card m-2" style="width: 15rem;">
            <a href="{{ url('/makeroom') }}">
                <img class="card-img-top p-2 rounded-circle" src="{{ asset('./images/ルーム作成.png') }}">
            </a>
            <button type="button" class="btn rounded-pill btn-primary mb-2" onclick="location.href='{{url('/makeroom')}}'">ルーム作成</button>
        </div>
        <div class="card m-2" style="width: 15rem;">
            <a href="{{ url('/ranking') }}">
                <img class="card-img-top p-2 rounded-circle" src="{{ asset('./images/ランキング余白改良形.png') }}">
            </a>
            <button type="button" class="btn rounded-pill btn-primary mb-2" onclick="location.href='{{url('/ranking')}}'">ランキングに行く</button>
        </div>
    </div>
    <br class="h-25">
    <div class="row row-cols-1 row-cols-lg-2 justify-content-center">
        <div class="card m-2" style="width: 15rem;">
            <a href="{{ url('/delroom') }}">
                <img class="card-img-top p-2 rounded-circle" src="{{ asset('./images/削除余白改良形.png') }}">
            </a>
            <button type="button" class="btn rounded-pill btn-primary mb-2" onclick="location.href='{{url('/delroom')}}'">ルーム削除</button>
        </div>
        <div class="card m-2" style="width: 15rem;">
            <a href="{{ url('/') }}">
                <img class="card-img-top p-2 rounded-circle" src="{{ asset('./images/説明余白改良形.png') }}">
            </a>
            <button type="button" class="btn rounded-pill btn-primary mb-2" onclick="location.href='{{url('/')}}'">説明を見る</button>
        </div>
        <div class="card m-2" style="width: 15rem;">
            <a href="{{ url('/') }}">
                <img class="card-img-top p-2 rounded-circle" src="{{ asset('./images/ログアウト余白改良形.png') }}">
            </a>
            <button type="button" class="btn btn-danger mb-2  rounded-pill" >ログアウト</button>
        </div>
    </div>


</body>
</html>

