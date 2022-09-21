@extends('header')

@section('head')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
@endsection
@section('body')
    <h1 class="text-center mt-5">お題作成フォーム</h1>
    <p class="fs-6 fst-italic text-center text-decoration-underline">Create a new theme</p>
    <div class="shadow-lg p-5 mb-5 mt-5 bg-body rounded w-50 container-fluid">
        <form action="" method="post" class="form-horizontal">
            <div class="form-group mb-5">
                <p class="form-floating">
                    <select class="form-select mt-2" id="category-select">
                        <option disabled selected>カテゴリーを選択してください</option>
                        <option>政治</option>
                        <option>芸能</option>
                        <option>スポーツ</option>
                        <option>恋愛</option>
                        <option>食べ物</option>
                        <option>その他</option>
                    </select>
                    <label for="category-select">Category</label>
                </p>
            </div>
            <p class="form-floating mt-4">
                <textarea placeholder="題名を入力" class="form-control mt-2" rows="3" id="content"></textarea>
                <label for="content">Title</label>
            </p>
            <input type="submit" class="btn btn-outline-primary btn-lg mt-3 p-lg-3 shadow" id="createroom" value="ルームの新規作成" >
            <span class="float-lg-end">
            <a onclick="window.location.reload();" class="btn btn-outline-danger btn-lg mt-3 p-lg-3 shadow">戻る</a>
        </span>
        </form>
    </div>
@endsection
