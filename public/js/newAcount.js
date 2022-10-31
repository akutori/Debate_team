function acount(){
    const adminName = document.getElementById("name");
    // 活性/非活性を切り替えるボタンのDOMを取得
    const adminAcount = document.getElementById("newAcount");

    // テキストボックスに入力された値を取得
    const text = adminName.value;

    if(text == "I like Debate") {
        // 入力文字があれば、display:noneを指定したクラスを取り除く
        adminAcount.className = null;
    } else {
        // 入力文字がなければ、display: noneを指定したクラスを設定する
        adminAcount.className = "hidden";
    }

}
