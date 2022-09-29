$(function() {
    timer();
    sendtext();
    get_data();
});

function get_data() {

    $.ajax({
        url: "result/ajax",
        dataType: "json",

        success: data => {
            $("#chat-data")
                .find(".chat-visible")
                .remove();

            for (var i = 0; i < data.chats.length; i++) {

                //時間の時と分を抽出
                const time = new Date(data.chats[i].created_at);
                const create_at = time.getHours() + ':' + time.getMinutes();
                //ポジションごとに文字の色を変更する
                let position = ''
                let positoncolor=''
                let svgicon = ''
                let chatcolor=''
                if(data.chats[i].users_position==="賛成"){
                    position = 'text-danger'
                    positoncolor = ''
                    svgicon =
                        '<span class="text-danger">' +
                        '<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-emoji-smile-fill" viewBox="0 0 16 16">\n' +
                        '  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zM4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z"/>\n' +
                        '</svg>' +
                        '</span>'
                    chatcolor = 'chatcolor-agree'
                }else{
                    position ='text-primary'
                    positoncolor = ''
                    svgicon =
                        '<span class="text-primary">' +
                        '<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-emoji-frown-fill" viewBox="0 0 16 16">\n' +
                        '  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm-2.715 5.933a.5.5 0 0 1-.183-.683A4.498 4.498 0 0 1 8 9.5a4.5 4.5 0 0 1 3.898 2.25.5.5 0 0 1-.866.5A3.498 3.498 0 0 0 8 10.5a3.498 3.498 0 0 0-3.032 1.75.5.5 0 0 1-.683.183zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z"/>\n' +
                        '</svg>' +
                        '</span>'
                    chatcolor = 'chatcolor-denial'
                }

                var html = `
                    <div class="chat-visible">
                    <div class="row ${positoncolor} mt-2 mb-2" id="chatalldata">
                        <div class="col-auto">
                            ${svgicon}
                            <span class="chat-body-user text-black fs-5 me-5 ms-2" id="user_name">${data.chats[i].user_name}</span>
                            <span class="chat-body-state fs-5 ${position}" id="users_positon">${data.chats[i].users_position}</span>
                        </div>
                        <div class="col-auto d-flex align-items-end">
                            <span class="chat-body-time text-secondary" id="created_at">${create_at}</span>
                        </div>
                    </div>
                    <div class="row mb-4 ms-3 ${positoncolor}">
                        <div class="col-12 py-2" id="${chatcolor}">
                            <span class="chat-body-message fs-5" id="message">${data.chats[i].message}</span>
                        </div>
                    </div>
                    </div>
                        `;
                $("#chat-data").append(html).fadeIn();
            }
        },
        error: () => {
            //alert("ajax Error");
            console.log("XMLHttpRequest : " + XMLHttpRequest.status);
            console.log("textStatus     : " + textStatus);
            console.log("errorThrown    : " + errorThrown.message);
        }
    });

    setTimeout("get_data()", 300);
}

//送信ボタンが押された際リロードを挟まずにチャットを登録
 function sendtext() {
    $('#chatform').submit(function(event) {
        // HTMLでの送信をキャンセル
        event.preventDefault();
        // 操作対象のフォーム要素を取得
        var $form = $(this);

        // 送信ボタンを取得
        // （後で使う: 二重送信を防止する。）
        var $button = $form.find('#submit');
        //テキスト欄を取得
        var $text = $form.find('#message');

        // 送信
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            //data形式を自動で認識、設定してくれる
            data: $form.serialize(),
            timeout: 400,

            // 送信前
            beforeSend: function(xhr, settings) {
                // ボタンを無効化し、二重送信を防止
                $button.attr('disabled', true);

            },
            // 応答後
            complete: function(xhr, textStatus) {
                // ボタンを有効化し、再送信を許可
                $button.attr('disabled', false);
                //テキストの内容を削除し再度チャットが打てるように
                $text.val('');
            },
            // 通信成功時の処理
            success: function(){

            },
            // 通信失敗時の処理
            error: function(xhr, textStatus, error) {

            }
        });

    });
}

function timer(){
    const ROOMID = $('#roomid').val()
    //ルームの開始時間を取得
    var RoomTime = new Date($('#starttime').val())
    //現在の時間を取得
    let NowTime = new Date()
    //分に+20を加えて終了時間を設定
    RoomTime.setMinutes(RoomTime.getMinutes()+20)

    var d = Math.floor((NowTime - RoomTime)/(24*60*60*1000))
    var h =Math.floor(((NowTime - RoomTime)%(24*60*60*1000))/(60*60*1000))
    //分を計算してマイナスを取り除く
    const m = Math.abs(Math.floor(((NowTime - RoomTime) % (24 * 60 * 60 * 1000)) / (60 * 1000)) % 60);
    //秒を計算してマイナスを取り除く
    const s = Math.abs(Math.floor(((NowTime - RoomTime) % (24 * 60 * 60 * 1000)) / 1000) % 60 % 60);
    //タイマー部分に表示させる
    $("#timer").text(m+'分'+s+'秒');
    if(m===59&&s===0){
        window.location.href = '/vote2/'+ROOMID+'/';
    }
    //1秒間隔でタイマーを実行
    setTimeout('timer()', 1000);
}
