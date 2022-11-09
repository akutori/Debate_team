@extends('header')

@section('head')
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <script src="{{asset('/js/app.js')}}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gentium+Plus:ital@1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">　
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@300&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="{{asset('css/genre.css')}}">
    <link rel="stylesheet" href="{{asset('js/genre.js')}}">

@endsection
@section('body')

    <div class="title">
        <h1>Choose Genre</h1>
        <h2>参加したいジャンルを選択してください</h2>
    </div>

    <div id="particles-js"></div>
    <div id="wrapper">

        <div class="genres">
            <div class="container-fluid mt-1">
                <div class="row">
                    @foreach($cate as $category)
                        <div class="col-4 d-flex justify-content-center">
                            <div class="card m-2 text-center border-5 border-dark" style="width: 15rem;">
                                <a href="{{url('/stheme/'.$category->c_id)}}"
                                   class="card-img-top justify-content-center">
                                    <img class="w-75" src="{{asset('images/'.$category->c_id.'.png')}}">
                                </a>
                                <span class="fs-3">{{$category->c_name}}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src={{asset('js/genre.js')}}></script>


    <!--
    <div class="test">
        <p><a href="{{url('/theme')}}">ジャンルに戻る</a> </p>
    </div>
    -->

@endsection
