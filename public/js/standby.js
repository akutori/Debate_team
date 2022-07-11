$(function() {
    get_data($("#roomid").val(),$("#state").val(),$("#userid").val());
});

function get_data($roomid,$state,$userid) {
    $.ajax({
        url: "/check/"+$roomid+"/"+$state+"/",
        dataType: "json",

        success: data => {
            //発表者が2人以下で傍観者が誰もいない時
            if(data.debater<2 && data.bystander <1) {
                //待ってほしいメッセージ
                $(".message").text("条件を満たしていません。人が来るまで待っててね");
                $(".debater").text("現在の発表者:"+data.debater+"人");
                $(".bystander").text("現在の傍観者:"+data.bystander+"人");

                //$("#state-data").append(html);
            }else{
                //条件が揃った処理
                /*
                    リダイレクト(チャットページ)
                */
                return window.location.href="/chat/"+data.room_id+"/"+data.state;
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
