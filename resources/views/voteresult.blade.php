<!DOCTYPE html>
<html lang="ja">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/vote.css')}}">
</head>
<body>
<p class="dai">結果</p>
<div class="san">
    <p class="vote-position">賛成派</p>
    @foreach($rodb as $ro)
        <p class="vote-cast">{{$ss = $ro->r_positive}}</p>
</div>
<div class="hite">
    <p class="vote-position">否定派</p>
    <p class="vote-cast">{{$uu = $ro->r_denial}}</p>
</div>

<div class="kekka">
    @if($ss > $uu )
        <p>肯定側勝利</p>

    @elseif($uu > $ss)
        <p>否定側勝利</p>
    @elseif($ss == $uu)
        <p>引き分け</p>
    @endif
</div>
<div class="resultbutton-center">
    <button type="button" class="backhome-button" onclick="location.href='{{url('/')}}'">トップに戻る</button>
</div>

@endforeach
</body>
</html>
