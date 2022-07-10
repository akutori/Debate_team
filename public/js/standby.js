$(function() {
    get_data();
});

function get_data() {
    $.ajax({
        url: "/check",
        dataType: "json",

        success: data => {
            /*$("#chat-data")
                .find(".chat-visible")
                .remove();*/
            //発表者が2人以下で傍観者が誰もいない時
            if(data.debater<2 && data.bystander <1) {
                //待ってほしいメッセージ
                var html = `
                            <div class="message">条件を満たしていません。人が来るまで待っててね</div>
                            <div class="debater">現在の発表者:${data.debater}人</div>
                            <div class="bystander">現在の傍観者:${data.bystander}人</div>
                        `;

                $("#chat-data").append(html);
            }else{
                //条件が揃った処理
                /*
                    リダイレクト(チャットページ)
                */
            }
        },
        error: () => {
            alert("ajax Error");
            console.log("XMLHttpRequest : " + XMLHttpRequest.status);
            console.log("textStatus     : " + textStatus);
            console.log("errorThrown    : " + errorThrown.message);
        }
    });

    setTimeout("get_data()", 5000);
}
