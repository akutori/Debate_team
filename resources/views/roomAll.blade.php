<!DOCTYPE html>
<html>
<head>

</head>
<body>
<h1>Room一覧</h1>
<form action="{{url('/roomAlls')}}" method="post">
    @csrf
    <select name="category">
        <option value="0">全て</option>
        @foreach($cate as $catego)
            <option value="{{$catego->c_id}}">{{$catego->c_name}}</option>
        @endforeach
    </select>
    <select name="user">
        <option value="0">全て</option>
        <option value="1">公式</option>
        <option value="2">ユーザ</option>
    </select>
    <input type="submit" value="検索">
</form>
@if(isset($room))
    @foreach($room as $roomone)
        @if(is_null($roomone->user_id))
            <input type="hidden" value="{{$user = '公式'}}">
        @else
            <input type="hidden" value="{{$user = $roomone->user_id}}">
        @endif
        <p>{{$roomone->c_name}}</p><p>{{$roomone->t_name}}</p><p>{{$user}}</p>
    @endforeach
@else
    <!--一度も検索してない場合の変数未定義対策-->
@endif
</body>
</html>
