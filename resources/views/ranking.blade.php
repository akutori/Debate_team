<html>
<body>
<h1>Mypage</h1>
<p>{{$username}}さん</p>
<button type="button" onclick="location.href='{{url('/sgenre')}}'">ジャンル選択</button>
<button type="button" onclick="location.href='{{url('/makeroom')}}'">ルーム作成</button>
<button type="button" onclick="location.href='{{url('/ranking')}}'">ランキングに行く</button>
<button type="button" onclick="location.href='{{url('/delroom')}}'">ルーム削除</button>
<button type="button" onclick="location.href='{{url('/readme')}}'">説明を見る</button>

@foreach($user as $users)
    <!-- top3 -->
    <div>
        <p>1位</p>
        <p>名前:{{$users[0]->name}}</p>
        <p>ポイント：{{$users[0]->u_point}}</p>
    </div>
    <div>
        <p>2位</p>
        <p>名前:{{$users[1]->name}}</p>
        <p>ポイント：{{$users[1]->u_point}}</p>
    </div>
    <div>
        <p>3位</p>
        <p>名前:{{$users[2]->name}}</p>
        <p>ポイント：{{$users[2]->u_point}}</p>
    </div>
    @for($i = 3; $i <count($users); $i++)
        {{$i+1}}位 名前：{{$users[$i]->name}}ポイント：{{$users[$i]->u_point}}<br>
    @endfor
@endforeach


</body>

</html>
