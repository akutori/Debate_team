<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{asset('css/head.css')}}">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <title>{{config('app.name')}}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    @yield('head')

</head>
<body>
<div class="ht">
    <a href="{{url('/sgenre')}}"><img class="rogo" src="{{asset('images/debate01.png')}}"></a>
</div>

<div class="container-sm p-1 text-center" id="btns">
    <!---ログイン,会員登録遷移--->
@if (Route::has('login'))
    <!--ログイン時、マイページ、ログアウトボタン表示-->
        @auth
            <button onclick="location.href='{{ url('/mypage') }}'" class="btn btn-secondary btn-outline-info text-white btn-lg me-5">マイページ</button>

            <form style="display: inline" action="{{ route('logout') }}" method="POST">
                @csrf
                <input type="submit" class=" btn btn-secondary btn-outline-danger text-white border-secondary btn-lg" value="ログアウト">
            </form>
            <!--ゲスト時、ログイン、ログアウトボタン表示-->
        @else
            <button onclick="location.href='{{ route('login') }}'" class="btn btn-secondary btn-outline-primary text-white border-secondary p-3 me-5">ログイン</button>

            @if (Route::has('register'))
                <button onclick="location.href='{{ route('register') }}'" class="btn btn-secondary btn-outline-primary text-white border-secondary">アカウント<br>登録</button>
            @endif
        @endauth
    @endif
</div>

@yield('body')

@yield('js')


</body>
</html>
