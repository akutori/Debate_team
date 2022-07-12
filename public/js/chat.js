$(function() {
    get_data();
});

function get_data() {
    $roomid = $("#roomid").val();
    $.ajax({
        url: "/3reedman3/public"+$roomid+"/result/ajax",
        dataType: "json",

        success: data => {
            $("#chat-data")
                .find(".chat-visible")
                .remove();

            for (var i = 0; i < data.chats.length; i++) {

                var html = `
                            <div class="media chat-visible">
                                <div class="media-body chat-body">
                                    <div class="row">
                                        <span class="chat-body-id" id="user_id">ID：${data.chats[i].user_id}</span>
                                        <span class="chat-body-user" id="user_name">＠${data.chats[i].user_name}</span>
                                        <span class="chat-body-time" id="created_at">${data.chats[i].created_at}</span>
                                    </div>
                                    <span class="chat-body-message" id="message">${data.chats[i].message}</span>
                                </div>
                            </div>
                        `;

                $("#chat-data").append(html);
            }
        },
        error: () => {
            alert("ajax Error");
            console.log("XMLHttpRequest : " + XMLHttpRequest.status);
            console.log("textStatus     : " + textStatus);
            console.log("errorThrown    : " + errorThrown.message);
        }
    });

    setTimeout("get_data()", 1000);
}
