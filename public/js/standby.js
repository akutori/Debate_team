$(function() {
    get_data();
});

function get_data() {
    var roomid = $("#roomid").val();
    var state = $("#state").val();
    var userid = $("#userid").val();
    $.ajax({

        url: "/check/"+roomid+"/"+state+"/",
        dataType: "json",

        success: data => {
            //発表者が2人以上で傍観者が1人入ってきた時
            if((data.debater >=2)&& data.bystander >= 1) {
                //条件が揃った処理
                /*
                    リダイレクト(チャットページ)
                */
                return window.location.href="/chat/"+data.room_id+"/"+data.state;
            }else{
                //待ってほしいメッセージ
                $(".message").text("条件を満たしていません。人が来るまで待っててね");
                $(".debater").text("現在の発表者:"+data.debater+"人");
                $(".bystander").text("現在の傍観者:"+data.bystander+"人");
            }
        },
        error: () => {
            alert("ajax Error");
            console.log("XMLHttpRequest : " + XMLHttpRequest.status);
            console.log("textStatus     : " + textStatus);
            console.log("errorThrown    : " + errorThrown.message);
        }
    });

    setTimeout("get_data()", 500);
}
