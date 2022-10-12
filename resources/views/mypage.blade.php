<html>
<body>
    <h1>Mypage</h1>
    <p>{{$username}}さん</p>
    <button type="button" onclick="location.href='{{url('/sgenre')}}'">ジャンル選択</button>
    <button type="button" onclick="location.href='{{url('/makeroom')}}'">ルーム作成</button>
    <button type="button" onclick="location.href='{{url('/ranking')}}'">ランキングに行く</button>
    <button type="button" onclick="location.href='{{url('/delroom')}}'">ルーム削除</button>
    <button type="button" onclick="location.href='{{url('/readme')}}'">説明を見る</button>
    <button type="button" >ログアウト</button>
</body>
</html>

