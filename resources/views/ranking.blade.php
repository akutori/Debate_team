<html lang="ja">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

<body>

<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-4">ランキング</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="#" class="nav-link active">ジャンル選択</a></li>
            <li class="nav-item"><a href="#" class="nav-link">マイページ</a></li>
            <li class="nav-item"><a href="#" class="nav-link">ログイン</a></li>

        </ul>
    </header>
</div>
@foreach($user as $users)
    <!-- top3 -->
    <div class="container-xxl" Style="margin:auto;margin-bottom: 20px ">
        <div class="list-group " style=" width: auto; max-width: 400px;--bs-list-group-color: #ffbc22">
            <a class="list-group-item ">1位</a>
            <a class="list-group-item">名前:{{$users[0]->name}}</a>
            <a class="list-group-item">ポイント：{{$users[0]->u_point}}</a>
        </div>
        <div class="list-group " style="float:left;width: 200px; --bs-list-group-color: #6d95a7">
            <a class="list-group-item">2位</a>
            <a class="list-group-item">名前:{{$users[1]->name}}</a>
            <ag class="list-group-item">ポイント：{{$users[1]->u_point}}</ag>
        </div>

        <div class="list-group" style="width:auto;max-width: 200px;--bs-list-group-color: #b17c00">

            <a class="list-group-item">3位</a>
            <a class="list-group-item">名前:{{$users[2]->name}}</a>
            <a class="list-group-item">ポイント：{{$users[2]->u_point}}</a>
        </div>
    </div>
    <div class="container-md" style="margin:auto;margin-bottom: 20px">
        @for($i = 3; $i <count($users); $i++)

            <div class="list-group" style="width:360px;">
                <a class="list-group-item"> {{$i+1}}位 名前：{{$users[$i]->name}} ポイント：{{$users[$i]->u_point}}</a>
            </div>

    @endfor
@endforeach

<script src="{{mix('js/app.js')}}"></script>
</body>
</html>


