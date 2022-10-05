$(function() {
    not_back();
    get_data();
    Text_Spotting();
});

function get_data() {
    var roomid = $("#roomid").val();
    var state = $("#state").val();
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
                const participants = data.debater + data.bystander;
                $('#participants').text(participants);
            }
        },
        error: () => {
            alert("ajax Error");
            console.log("XMLHttpRequest : " + XMLHttpRequest.status);
            console.log("textStatus     : " + textStatus);
            console.log("errorThrown    : " + errorThrown.message);
        }
    });
    setTimeout("get_data()", 2000);
}

function not_back() {
    //ブラウザバックを禁止する
    $(function() {
        history.pushState(null, null, null);

        $(window).on("popstate", function(){
            history.pushState(null, null, null);
        });
    });
}

function Text_Spotting(){
    setInterval(function(){
        $('#dot').fadeOut(500,function(){
            $(this).fadeIn(500)
        });
    },1000);
}
