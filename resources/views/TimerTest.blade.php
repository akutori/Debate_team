<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/Style.css')}}">
    <title>Document</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery.simple.timer.js')}}"></script>

    <!--タイマーの初期化 class="timer"にカウントダウンを表示する-->
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
      //setTimeout(function(){
        //    window.location.href = 'TimerTest2.html';
        //}, 10*1000);
        </script>
</head>
<body>
    <!--タイマーを分単位で指定
        <div class='timer' data-minutes-left="1"></div>

    -->

    <!--タイマーを秒単位で指定　ここでは２秒-->
        <div class='timer' data-seconds-left="2"></div>



</body>
</html>
