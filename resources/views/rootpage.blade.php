@extends('header')

@section('head')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
@endsection
<body>
<h1 class="text-center p-5 display-1"><strong>管理者画面</strong></h1>
<div class="container-fluid">

    <div class="row pb-lg-5 me-5">
        <div class="col-9 text-end align-self-center">
            <p class="display-3">{{$adminName}}さん</p>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-lg-2 justify-content-center">

        <div class="col col-lg-auto card my-3 mx-auto mx-lg-3 shadow-lg" style="width: 17rem;">
            <img src="{{ asset('./images/ngword.png') }}" alt="NGの画像" class="card-img-top p-2 rounded-circle">
            <div class="card-body">
                <h5 class="card-title">NGワード編集</h5>
                <p class="card-text">登録されたNGワードを確認します</p>
                <a href="{{url('/ngwordEdit')}}" class="btn btn-primary btn-lg shadow-lg">NGワード編集</a>
            </div>
        </div>

        <div class="col col-lg-auto card my-3 mx-auto mx-lg-3 shadow-lg" style="width: 17rem;">
            <img src="{{ asset('./images/ルーム作成新.png') }}" alt="ルーム作成の画像" class="card-img-top p-2 rounded-circle">
            <div class="card-body">
                <h5 class="card-title">お題作成</h5>
                <p class="card-text">公式が考えたお題で部屋を作成します</p>
                <a href="{{url('/addTitle', compact( 'adminName'))}}" class="btn btn-primary btn-lg shadow-lg">お題作成</a>
            </div>
        </div>

        <div class="col col-lg-auto card my-3 mx-auto mx-lg-3 shadow-lg" style="width: 17rem;">
            <img src="{{ asset('./images/一覧余白改良形.png') }}" alt="ルームの画像" class="card-img-top p-2 rounded-circle">
            <div class="card-body">
                <h5 class="card-title">ルーム一覧</h5>
                <p class="card-text">ディベートがされているルームを全て表示します</p>
                <a href="{{url('roomAll')}}" class="btn btn-primary btn-lg shadow-lg">ルーム一覧</a>
            </div>
        </div>

        <!--
        <div class="col col-lg-auto card my-3 mx-auto mx-lg-3 shadow-lg" style="width: 17rem;">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgztcjMq8MIAMhtZHNQ53IiijOUOjklbpP1g&usqp=CAU" alt="時計の画像" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">チャット時間の更新</h5>
                <p class="card-text">ディベートの時間の編集をします</p>
                <a href="{{url('timeChange')}}" class="btn btn-primary btn-lg shadow-lg">チャット時間の編集</a>
            </div>
        </div>
        -->

    </div>
</div>
</body>
