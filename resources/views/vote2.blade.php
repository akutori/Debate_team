<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>where-out</title>
</head>
<body>

@foreach ($bydb as $row)
    <p>{{$row->user_id}}</p>
@endforeach



<!--納得したかボタンでダイアログ表示し、判定-->
<dialog id="dialog" class="dialog_style" >
    <div class="back"></div>
    <div class="nnn">
        <p class="p1">どちらの意見に納得しましたか？</p>
        <div class="button1">

            <button type="button" name="positive" onClick="clickDisplayAlert(1)" >肯定側</button>
            <button type="button" name="denial" onClick="clickDisplayAlert(2)">否定側</button>


        </div>
    </div>
</dialog>

<!--u_idが取得された者だけにアンケートを表示させる＜未完成＞-->


<!--押されたボタンでデータベースに投票結果を登録-->
<script>
    function clickDisplayAlert(num) {

        //肯定側がクリックされた時
        if(num === 1){
            if(!alert("集計しています")) {
                // OKが押された際に実行する処理
                setTimeout(function () {
                    window.location.href = "{{url('/voteko',compact('rid'))}}";
                }, 15 * 1000);
            }

            //否定側がクリックされた時
        } else if(num === 2){
            if(!alert("集計しています")) {
                setTimeout(function () {
                    window.location.href = "{{url('/votesan',compact('rid'))}}";
                }, 15 * 1000);
            }
        }
    }
</script>

<!--チャットの制限時間、時間終了し20秒後結果画面に遷移-->
<div class="timer" data-seconds-left=5></div>
<p>{{$rid}}</p>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/jquery.simple.timer.js')}}"></script>

<script>
    $(function(){
        $('.timer').startTimer({
            onComplete: function(){
                @if($flg == 1)
                    document.getElementById('dialog').show();
                @endif
                setTimeout(function () {
                    window.location.href = '{{url('/vote',compact('rid'))}}';
                }, 20 * 1000);

            }
        });
    });
</script>
@if($flg == 0)
    <h2>現在投票中です</h2>
@endif
</body>
</html>
