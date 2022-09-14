<html>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery.simple.timer.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/vote.css')}}">
    <script>
        $(function(){
            $('.timer').startTimer({
                onComplete:function(element){
                    //カウントダウン終了時にdiv class="timer"をcompleteへ変更する
                    element.addClass('complete');
                }
            });

        });


        //10秒後に指定したリンクへ飛ぶ
        setTimeout(function(){
            window.location.href = '{{url('/vote3',compact('rid'))}}';
        }, 30*1000);
    </script>
</head>
<body>
<div class="cent">
    <h2 class="syuukei">counting now</h2>
    <div id="tit" class="timer" data-seconds-left=30></div>
    <p class="ct">...</p>
</div>
</body>
</html>

