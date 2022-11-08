@extends('header')

@section('head')

@endsection
@section('body')
    <h1>公式のお題作成</h1>
    <form action="{{url('/titleInsert')}}" method="post">
        @csrf
        <a href="{{url('/root')}}">管理者画面へ戻る</a>
        <p>カテゴリー一覧
            <select name="category">
                @foreach($categoryList as $category)
                    <option value="{{$category->c_id}}">{{$category->c_name}}</option>
                @endforeach
            </select>
        </p>
        <p class="form-floating mt-4">
            <textarea placeholder="題名を入力" class="form-control mt-2" rows="3" id="content" name="title"></textarea>
            <label for="content">Title</label>
        </p>
        <input type="hidden" name="adminName" value="{{$adminName}}">
        <button type="submit">登録</button>
    </form>
@endsection
