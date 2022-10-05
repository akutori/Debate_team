<html lang="ja">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <body>
@foreach($user as $users)
    <!-- top3 -->
     <div class="list-group" style="max-width: 400px; ">
        <a class="list-group-item">1位</a>
        <a class="list-group-item">名前:{{$users[0]->name}}</a>
        <a class="list-group-item">ポイント：{{$users[0]->u_point}}</a>
    </div>
    <div>
        <p>2位</p>
        <p>名前:{{$users[1]->name}}</p>
        <p>ポイント：{{$users[1]->u_point}}</p>
    </div>
        <p>3位</p>
        <p>名前:{{$users[2]->name}}</p>
        <p>ポイント：{{$users[2]->u_point}}</p>
    </div>
    @for($i = 3; $i <count($users); $i++)
        <div class="list-group" style="max-width: 400px;">
            <a class="list-group-item"> {{$i+1}}位 名前：{{$users[$i]->name}}  ポイント：{{$users[$i]->u_point}}</a>
        </div>
    @endfor
@endforeach
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>


