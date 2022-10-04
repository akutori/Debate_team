@extends('header')

@section('head')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
@endsection
@section('body')
    <h1 class="text-center mt-5 pt-5">お題作成フォーム</h1>
    <p class="fs-6 fst-italic text-center text-decoration-underline">Create a new theme</p>
    <div class="shadow-lg p-5 mb-5 mt-3 bg-body rounded w-50 container-fluid">
        @if(isset($alerttext))
            {!! $alerttext !!}
        @endif
        <form action="{{url('/makeroom/create')}}" method="post" class="form-horizontal">
            @csrf
            <input type="hidden" value="{{$userid}}" name="userid">
            <div class="form-group mb-5">
                <p class="form-floating">
                    <select class="form-select mt-2" id="category-select" name="categoryid" required>
                        <option value="" disabled selected>カテゴリーを選択してください</option>
                        @foreach($categorys as $category)
                            <option value="{{$category->c_id}}">{{$category->c_name}}</option>
                        @endforeach
                    </select>
                    <label for="category-select">Category</label>
                </p>
            </div>
            <p class="form-floating mt-4">
                <textarea placeholder="題名を入力" class="form-control mt-2" rows="3" id="content" name="title" minlength="0" maxlength="255" required></textarea>
                <label for="content">Title</label>
            </p>
            <input type="submit" class="btn btn-outline-primary btn-lg mt-3 p-lg-3 shadow" id="createroom" value="ルームの新規作成" >
            <span class="float-lg-end">
                <a onclick="window.location.reload();" class="btn btn-outline-danger btn-lg mt-3 p-lg-3 shadow">戻る</a>
            </span>
        </form>
    </div>
@endsection
