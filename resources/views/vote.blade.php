<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/vote.css')}}">

</head>
<body>
<!--<meta http-equiv="refresh" content=" 5; {{url('/vote2')}}">-->
<p class="dai">結果</p>
<div class="san">
    <p>賛成派</p>
    @foreach($rodb as $ro)
        <p>{{$ss = $ro->r_positive}}</p>
</div>
<div class="hite">
    <p>否定派</p>
    <p>{{$uu = $ro->r_denial}}</p>
</div>

<!--{{$sum = $ro->r_sum/2}}-->

<div class="kekka">
    @if($ss > $uu )
        <p>肯定側勝利</p>
    @elseif($uu > $ss)
        <p>否定側勝利</p>
    @elseif($ss == $uu)
        <p>引き分け</p>
@endif
</div>

<button type="button" onclick="location.href='{{url('/sgenre')}}'">トップに戻る</button>

@endforeach
</body>
</html>

