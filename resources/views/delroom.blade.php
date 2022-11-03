<html>
<head>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/standby.css')}}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/standby.js')}}"></script>
</head>
<body>
<h1>DelRoom</h1>
<h2>{{$text}}</h2>
    @if($rodb!='[]')

        @foreach($rodb as $room)

            {{$room->t_name}}
            <button class="btn btn-outline-primary shadow" data-bs-toggle="modal" data-bs-target="#exitModal{{$room->r_id}}">削除</button>
            <br>

            <div class="modal fade" id="exitModal{{$room->r_id}}" tabindex="-1" aria-labelledby="exitModalLabel" aria-hidden="true" data-bs-backdrop="static">

                <!--削除するルームを変数へ-->
                <input type="hidden" value="{{$rid=$room->r_id}}">

                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exitModalLabel">ルームを削除しようとしています!!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ルームを削除しますか?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="location.href='{{url('/delroom/'.$room->r_id)}}'">削除</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">戻る</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <h2>ルームがありません</h2>
    @endif
    <button type="button" class="btn btn-secondary" onclick="location.href='{{url('/mypage')}}'">mypageに戻る</button>
</body>
</html>
