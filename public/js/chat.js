$(function() {
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

/*<span class="chat-body-time" id="created_at">${data.chats[i].created_at}</span>*/
            for (var i = 0; i < data.chats.length; i++) {

                //時間の時と分を抽出
                const time = new Date(data.chats[i].created_at);
                const create_at = time.getHours() + ':' + time.getMinutes();
                let position = ''
                if(data.chats[i].users_position==="賛成"){
                    position = 'text-danger'
                }else{
                    position ='text-primary'
                }

                var html = `
                    <div class="row">
                        <div class="col-auto">
                            <span class="chat-body-user text-black fs-5 me-5" id="user_name">${data.chats[i].user_name}</span>
                            <span class="chat-body-state fs-5 ${position}" id="users_positon">${data.chats[i].users_position}</span>
                        </div>
                        <div class="col-auto d-flex align-items-end">
                            <span class="chat-body-time text-secondary" id="created_at">${create_at}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <span class="chat-body-message fs-5" id="message">${data.chats[i].message}</span>
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

    //setTimeout("get_data()", 300);
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
