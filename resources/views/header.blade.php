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
        <a href="{{url('/sgenre')}}" ><img class="rogo" src="{{asset('images/debate01.png')}}"></a>
    </div>

<div class="container-sm p-5 text-center">


        <!---ログイン,会員登録遷移--->
        @if (Route::has('login'))


                @auth
                    <button onclick="location.href='{{ url('/mypage') }}'" class=" btn btn-primary">マイページ</button>

            <form style="display: inline" action="{{ route('logout') }}" method="POST" >
                @csrf
                <input type="submit" class=" btn btn-danger" value="ログアウト">
            </form>

                @else
                    <button onclick="location.href='{{ route('login') }}'" class="btn btn-primary">ログイン</button>

                    @if (Route::has('register'))
                        <button onclick="location.href='{{ route('register') }}'" class="btn btn-primary ">アカウント登録</button>
                    @endif
                @endauth


        @endif

    </div>
</div>

    @yield('body')

        @yield('js')


</body>
</html>
