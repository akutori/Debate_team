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
    <div class="regi">


        <!---ログイン,会員登録遷移--->
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <button onclick="location.href='{{ url('/home') }}'" class=" text-sm text-gray-700 dark:text-gray-500 underline">Home</button>
                @else
                    <button onclick="location.href='{{ route('login') }}'" class="btn btn-primary text-sm text-gray-700 dark:text-gray-500 underline">ログイン</button>

                    @if (Route::has('register'))
                        <button onclick="location.href='{{ route('register') }}'" class="btn btn-primary ml-4 text-sm text-gray-700 dark:text-gray-500 underline">アカウント登録</button>
                    @endif
                @endauth
            </div>
        @endif
    </div>
    @yield('body')

        @yield('js')


</body>
</html>
