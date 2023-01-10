// 現在時刻から20秒を引く
const endTime = new Date().getTime() + 20 * 1000;

// 1秒ごとにカウントダウンする関数
function countDown() {

    //遷移に必要なルームIDを取得
    const roomid = document.querySelector('#roomid').value;
    // 現在時刻を取得する
    const currentTime = new Date().getTime();
    // 終了時刻から現在時刻を引く
    let leftTime = endTime - currentTime;
    // 秒数を取得する
    let seconds = Math.floor(leftTime / 1000);

    if(seconds <=10){
        document.getElementById('timer').style.color ='#ff2e2e';
    }
    // HTMLのpタグに秒数を反映する
    document.getElementById('timer').innerHTML = `残り${seconds}秒`;

    // カウントダウンが0秒になった場合は、URLに遷移する
    if (seconds === 0) {
        clearInterval(timer);
        location.href = '/vote/result?roomid=' + roomid;
    }
}

// 1秒ごとにcountDown関数を実行する
const timer = setInterval(countDown, 1000);

// 賛成&反対の情報を送信させ、「Plese Wait」の点を点滅させる
function voteFunction(event) {

    // submitイベントのデフォルトの動作をキャンセルする
    event.preventDefault();
    // クリックされたボタンを取得する
    const button = event.target;
    // クリックされたボタンのvalue属性を取得する
    const value = button.value;
    // form要素を取得
    const form = document.querySelector('form');
    // form要素からaction属性を取得
    const action = form.getAttribute('action');
    // form要素からmethod属性を取得
    const method = form.getAttribute('method');
    // FormDataオブジェクトを作成する
    const formData = new FormData(form);

    // FormDataオブジェクトに、'vote'という名前でvalue属性の値を追加する
    formData.append('vote', value);

    // Fetch APIを使用してAJAX通信を行います
    fetch(action, {
        method: method,
        body: formData
    })
    .then((response) => {
        // AJAX通信が完了したときの処理を記述する

        // ボタンを非表示にする
        document.getElementById('good').style.display = 'none';
        document.getElementById('bad').style.display = 'none';

        // 「何もせずにお待ち下さい」と表示する処理をここに書く
        document.getElementById('votedwaitmessage').innerHTML = 'Please Wait. . .';
        document.getElementById('votedmessage').innerHTML = '何もせずにお待ち下さい';

        flashing_dot();

    })
    //送信失敗時の処理
    .catch((error) => {
        // ボタンを非表示にする
        document.getElementById('good').style.display = 'none';
        document.getElementById('bad').style.display = 'none';

        // 「何もせずにお待ち下さい」と表示する処理をここに書く
        document.getElementById('votedwaitmessage').innerHTML = '送信できませんでした';
        document.getElementById('votedmessage').innerHTML = '';
    });
}
// 「Please Wait ...」のドットを点滅させる
function flashing_dot() {
    document.getElementById('votedwaitmessage').animate(
        [
            { opacity: 0 },
            { opacity: 1 }
        ],
        {
            duration: 1000,
            iterations: Infinity,
            direction: 'alternate'
        }
    );
}

window.addEventListener('load',()=>{
    document.getElementById('votewaitmessage').animate(
        [
            { opacity: 0 },
            { opacity: 1 }
        ],
        {
            duration: 1000,
            iterations: Infinity,
            direction: 'alternate'
        }
    );
})

//ブラウザバックを無効化
window.addEventListener("DOMContentLoaded", function () {
    history.pushState(null, null, null);

    window.addEventListener("popstate", function () {
        history.pushState(null, null, null);
    });
});
