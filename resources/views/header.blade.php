<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{asset('css/head.css')}}">
    <title>{{config('app.name')}}</title>
    @yield('head')
</head>
<body>
    <div class="ht">
        <a href="{{url('/sgenre')}}" ><img class="rogo" src="{{asset('images/debate01.png')}}"></a>
    </div>
    @yield('body')

    <!---ログイン,会員登録遷移--->
    @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

</body>
</html>
