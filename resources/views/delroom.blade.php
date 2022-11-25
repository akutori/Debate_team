<html>
<head>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/standby.css')}}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/standby.js')}}"></script>
</head>
<body>
<p class="fs-1 text-center">DelRoom</p>

@if($rodb!='[]')

    @foreach($rodb as $room)
        <div class="container shadow-lg border border-dark  text-center mt-2  rounded-pill border-1 ">
            <span class="text-center fs-2 text-wrap"> {{$room->t_name}}</span>
            <br>
            <button class="btn btn-outline-primary shadow text-center" data-bs-toggle="modal"
                    data-bs-target="#exitModal{{$room->r_id}}">削除
            </button>


            <div class="modal fade " id="exitModal{{$room->r_id}}" tabindex="-1" aria-labelledby="exitModalLabel"
                 aria-hidden="true" data-bs-backdrop="static">

                <!--削除するルームを変数へ-->
                <input type="hidden" value="{{$rid=$room->r_id}}">

                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exitModalLabel">ルームを削除しようとしています!!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span class="text-wrap" style="width: 6px;">{{$room->t_name}}</span>を削除しますか?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    onclick="location.href='{{url('/delroom/'.$room->r_id)}}'">削除
                            </button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">戻る</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
            @endforeach
            @else
                <p class="text-center fs-1">ルームがありません</p>
            @endif
            <div class="text-center mt-5">
                <button type="button" class="btn btn-primary text-white" onclick="location.href='{{url('/mypage')}}'">Mypageに戻る
                </button>
            </div>
<p class="text-center fs-1 mt-5">{{$text}}</p>


</body>
</html>
