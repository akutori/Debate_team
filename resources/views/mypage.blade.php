<html>
<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
<body>
<div class="grid text-center">
    <a href="{{url('/sgenre')}}" ><img class="w-50 h-50" src="{{asset('images/debate01.png')}}"></a>
</div>
    <h1>Mypage</h1>
    <p>{{$username}}さん</p>
    <p>
        ><a class="btn btn-link" href="{{ url('root') }}">
            {{ __('管理者の方はこちら') }}
        </a>
    </p>



    <div class="col grid text-center h-25 ">

        <a href="{{url('/stheme/')}}" class="delay-time fadeUp "><img class="genreimg" src="{{asset('images/')}}"></a>
    <button type="button" class="g-col-6 " onclick="location.href='{{url('/sgenre')}}'">ジャンル選択</button>
    <button type="button" class="g-col-6" onclick="location.href='{{url('/makeroom')}}'">ルーム作成</button>
    <button type="button" class="g-col-6" onclick="location.href='{{url('/ranking')}}'">ランキングに行く</button>
    </div>

    <div class="col grid text-center ">
    <button type="button" class="g-col-6" onclick="location.href='{{url('/delroom')}}'">ルーム削除</button>
    <button type="button" class="g-col-6" onclick="location.href='{{url('/readme')}}'">説明を見る</button>
    <button type="button" class="g-col-6" >ログアウト</button>
    </div>


</body>
</html>

