<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>{{config('app.name')}}</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg mb-3">
    <div class="container-fluid">
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="ナビゲーションの切替">
            <span class="navbar-toggler-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </span>
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
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exitModal"
                               href="#">ログアウト</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <form action="{{url('/userroom/')}}" method="get" class="d-flex mx-auto" role="search">
                <input type="search" name="word" class="form-control me-2" placeholder="検索..." aria-label="検索...">

                <select name="state" class="form-control w-auto me-2">
                    <option value="1">ルーム名</option>
                    <option value="0">ユーザー名</option>
                </select>

                <select name="genre" class="form-control w-auto me-3">
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
    @if(isset($word))
        @if(isset($genre))
            {{"ジャンル: 「".$genre->c_name."」"}}
        @endif
        {{$state}}「{{$word}}」の検索結果
    @endif
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
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <input type="submit" class="btn btn-secondary" value="ログアウト">
                </form>
            </div>
        </div>
    </div>
</div>
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
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger text-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-exclamation-triangle flex-shrink-0 ms-4 position-absolute top-50 start-0 translate-middle" viewBox="0 0 16 15">
                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
            </svg>
            <strong class="fs-4">{{$error}}</strong>
            <button type="button" class="btn-close float-end border-0" data-bs-dismiss="alert" aria-label="閉じる"></button>
        </div>
    @endforeach
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
                    <form action="{{url('/userroom/create')}}" method="post" class="form-horizontal">
                        @csrf
                        <input type="hidden" value="{{$userid}}" name="userid">
                        <div class="form-group mb-4">
                            <p><span class="fs-5">カテゴリー</span>
                                <select class="form-select mt-2 mb-3 p-4 p-md-2" id="category-select" name="categoryid"
                                        required>
                                    <option value="" disabled selected>カテゴリーを選択してください</option>
                                    @foreach($categorys as $category)
                                        <option value="{{$category->c_id}}">{{$category->c_name}}</option>
                                    @endforeach
                                </select>
                            </p>
                        </div>
                        <p><span class="fs-5">題名</span>
                            <input type="text" placeholder="題名を入力" maxlength="255" minlength="1" name="title" required
                                   class="form-control py-4 form-control-lg mt-2">
                        </p>
                        <input type="submit" class="btn btn-outline-primary btn-lg mt-3 p-lg-3 shadow"
                               id="createroom"
                               value="ルームの新規作成">
                        <span class="float-lg-end">
                                <button type="button" class="btn btn-outline-danger btn-lg mt-3 p-lg-3 shadow"
                                        data-bs-dismiss="modal">閉じる</button>
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

<div class="container mt-5 text-light">
    {{-- 一行のコンテンツ --}}
    @if(isset($rooms))
        @foreach($rooms as $room)
            <div class="row mb-5" style="background-color: rgb(14,92,102)">
                <div class="col-2 text-dark">
                    @if(\Illuminate\Support\Facades\Auth::id()==$room->id)
                        <div class="row" style="background-color: #ff6a00;">
                            <div class="col-lg-6 fs-5 text-center">ユーザー</div>
                            <div class="col-lg-6 fs-5 text-center"><strong>{{$room->name}}</strong></div>
                    @else
                        <div class="row" style="background-color: #ffd255;">
                            <div class="col-lg-6 fs-5 text-center">ユーザー</div>
                            <div class="col-lg-6 fs-5 text-center">{{$room->name}}</div>
                    @endif
                    </div>
                    <div class="row" style="background-color: #ffbb00;">
                        <div class="col-lg-6 fs-5 text-center">ジャンル</div>
                        <div class="col-lg-6 fs-5 text-center">{{$room->c_name}}</div>
                    </div>
                </div>
                <a type="button" class="col-10 fs-1 text-center text-light text-decoration-none" data-bs-toggle="modal"
                   data-bs-target="#selectroom{{$room->r_id}}">
                    {{$room->t_name}}
                </a>
                <!-- モーダルの設定 -->
                <div class="modal fade text-dark" id="selectroom{{$room->r_id}}" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1"
                     aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-4" id="staticBackdropLabel">
                                    {{$room->t_name}}
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="閉じる"></button>
                            </div>
                            <form action="{{url('/standby')}}" method="get">{{--todo パラメータを合わせるまでは保留--}}
                                <input type="hidden" name="roomid" value="{{$room->r_id}}">
                                <div class="modal-body">
                                    <p class="fs-3 pb-2 text-center">立場を選択</p>
                                    <div class="form-check ms-5">
                                        <input type="radio" value="0" class="form-check-input fs-4" name="position"
                                               id="debater" required>
                                        <label for="debater" class="form-check-label fs-4">
                                            発表者<span class="fs-5 ms-2">(立場はランダムに選ばれます)</span>
                                        </label>
                                    </div>
                                    <div class="form-check ms-5">
                                        <input type="radio" value="1" class="form-check-input fs-4" name="position"
                                               id="bystander" required>
                                        <label for="bystander" class="form-check-label fs-4">
                                            傍観者
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                                    <button type="submit" class="btn btn-primary">入室</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            {{--  --}}
        @endforeach
    @endif
</div>
</body>
</html>

