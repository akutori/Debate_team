<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<h1>NGワード画面</h1>

<!-- NGwordを登録する用のボタン -->
<button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#ngwordModal">
    追加登録
</button>

<form method="post" action="{{ url('/ngDelete') }}">
    @csrf
    <h1>キーワード一覧and削除</h1>

    @foreach( $list as $ng )
        <p><input type="checkbox" name="ngs[]" value="{{ $ng -> n_id  }}">{{ $ng -> n_words }}</p>
    @endforeach

    <button type="submit">削除</button>
</form>

<!-- NGwordを登録するモーダルを表示 -->
<div class="modal fade" id="ngwordModal" tabindex="-1" aria-labelledby="ngwordTitle" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('/ngwordEdit/insert') }}" method="get">
                <div class="modal-header">
                    <h5 class="modal-title" id="ngwordTitle">NGword 新規登録♪</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    登録したいキーワードを入力してください
                    <input type="text" class="form-control" name="ngword">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">戻る</button>
                    <button type="submit" class="btn btn-outline-primary">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var ngwordModal = document.getElementById('ngwordModal')
    ngwordModal.addEventListener('click', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = exampleModal.querySelector('.modal-title')
        var modalBodyInput = exampleModal.querySelector('.modal-body input')

        modalTitle.textContent = 'New message to ' + recipient
        modalBodyInput.value = recipient
    })
</script>
</body>
</html>

