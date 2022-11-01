function acount(){
    const adminName = document.getElementById("name").value;
    // 活性/非活性を切り替えるボタンのDOMを取得
    const adminAcount = document.getElementById("newAcount");

    if(adminName == "I like Debate") {
        // 入力文字があれば、display:noneを指定したクラスを取り除く
        adminAcount.className = null;
    } else {
        // 入力文字がなければ、display: noneを指定したクラスを設定する
        adminAcount.className = "hidden";
    }

}
