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
</body>
</html>
