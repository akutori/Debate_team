@extends('header')

@section('head')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Gentium+Plus:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/theme.css')}}">
    <link rel="stylesheet" href="{{asset('js/theme.js')}}">
@endsection
@section('body')
    <body>
    <nav class="navbar navbar-expand-lg mb-3">
        <div class="container-fluid">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="ナビゲーションの切替">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand mx-5" href="{{url('/mypage')}}">ルーム作成&ルーム一覧</a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{url('/mypage')}}">ホーム</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/sgenre')}}">ディベート</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/ranking')}}">ランキング</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">メニュー</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{url('/delroom')}}">ルーム削除</a></li>
                            <li><a class="dropdown-item" href="{{url('/readme')}}">説明を見る</a></li>
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exitModal" href="#">ログアウト</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex mx-auto" role="search">
                    <input type="search" class="form-control me-2" placeholder="検索..." aria-label="検索...">

                    <select name="state" class="form-control w-auto me-2">
                        <option value="">ルーム名</option>
                        <option value="">ユーザー名</option>
                    </select>

                    <select name="state" class="form-control w-auto me-3">
                        <option value="0">すべてのジャンル</option>
                        @foreach($categorys as $category)
                            <option value="{{$category->c_id}}">{{$category->c_name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-outline-success flex-shrink-0">検索</button>
                </form>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>

    <div class="fs-1 text-center mb-3 mt-5">
        {{--  @if()
        @endif --}}
    </div>

    <!-- モーダルの設定 -->
    <div class="modal fade" id="exitModal" tabindex="-1" aria-labelledby="exitModalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ログアウトしようとしています</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                </div>
                <div class="modal-body">
                    <p class="fs-5 text-center">ログアウトしますか?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">閉じる</button>
                    <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('logout') }}'">
                        ログアウト
                    </button>
                </div><!-- /.modal-footer -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="container">
        <div class="row">
            <!-- 切り替えボタンの設定 -->
            <div class="col-5"></div>
            <button type="button" class="btn btn-outline-primary btn-lg shadow-lg mb-4 col-2" data-bs-toggle="modal"
                    data-bs-target="#makeroom">
                ルーム作成
            </button>
            <div class="col-5"></div>
        </div>
        @if(isset($alerttext))
            {!! $alerttext !!}
        @endif
    </div>

    <!-- モーダルの設定 -->
    <div class="modal fade" id="makeroom" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticmakeroomLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticmakeroomLabel">ルーム作成</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                </div>
                <div class="modal-body">
                    <h1 class="text-center mt-5">お題作成フォーム</h1>
                    <p class="fs-6 fst-italic text-center text-decoration-underline">Create a new theme</p>
                    <div class="py-2 mb-5 bg-body rounded container-fluid w-50">
                        <form action="{{url('/makeroom/create')}}" method="post" class="form-horizontal">
                            <div class="form-group mb-4">
                                <p><span class="fs-5">カテゴリー</span>
                                    <select class="form-select mt-2 mb-3 p-4 p-md-2">
                                        <option value="" disabled selected>カテゴリーを選択してください</option>
                                        @foreach($categorys as $category)
                                            <option value="{{$category->c_id}}">{{$category->c_name}}</option>
                                        @endforeach
                                    </select>
                                </p>
                            </div>
                            <p><span class="fs-5">題名</span>
                                <input type="text" placeholder="題名を入力" class="form-control py-4 form-control-lg mt-2">
                            </p>
                            <input type="submit" class="btn btn-outline-primary btn-lg mt-3 p-lg-3 shadow"
                                   id="createroom"
                                   value="ルームの新規作成">
                            <span class="float-lg-end">
                                <button type="button" class="btn btn-outline-danger btn-lg mt-3 p-lg-3 shadow" data-bs-dismiss="modal">閉じる</button>
                            </span>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container shadow-lg mt-5 text-light">
        {{-- 一行のコンテンツ --}}
        @if(isset($rooms))
            @foreach($rooms as $room)
        <div class="row mb-5" style="background-color: rgb(14,92,102)">
            <div class="col-2 text-dark">
                <div class="row" style="background-color: #ffd255;">
                    <div class="col-lg-6 fs-5 text-center">ユーザー</div>
                    <div class="col-lg-6 fs-5 text-center">{{$room->name}}</div>
                </div>
                <div class="row" style="background-color: #ffbb00;">
                    <div class="col-lg-6 fs-5 text-center">ジャンル</div>
                    <div class="col-lg-6 fs-5 text-center">{{$rooom->c_name}}</div>
                </div>
            </div>
            <div class="col-10 fs-1 text-center">
                <a type="button" class="text-light text-decoration-none" data-bs-toggle="modal"
                   data-bs-target="#selectroom">
                    {{$room->t_name}}
                </a>
            </div>

            <!-- モーダルの設定 -->
            <div class="modal fade text-dark" id="selectroom" data-bs-backdrop="static" data-bs-keyboard="false"
                 tabindex="-1"
                 aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                {{$room->t_name}}
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">{{--todoパラメータを合わせるまでは保留--}}
                                <p class="fs-3 pb-2">立場を選択</p>
                                <div class="form-check ms-5">
                                    <input type="radio" value="発表者" class="form-check-input fs-4" name="position" id="debater">
                                    <label for="debater" class="form-check-label fs-4">
                                        発表者<span class="fs-5 ms-2">(立場はランダムに選ばれます)</span>
                                    </label>
                                </div>
                                <div class="form-check ms-5">
                                    <input type="radio" value="傍観者" class="form-check-input fs-4" name="position" id="bystander">
                                    <label for="bystander" class="form-check-label fs-4">
                                        傍観者
                                    </label>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                            <button type="button" class="btn btn-primary">入室</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{--  --}}
            @endforeach
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>
    </body>
    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
@endsection
