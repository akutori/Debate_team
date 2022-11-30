@extends('header')

@section('head')

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

@endsection

<div class="m-lg-5">
<h1 class="alert-danger display-5">始めにお読みください</h1>
<div class="mb-lg-4 mt-lg-4">
<div style="font-size: 1.1em" class="mb-xxl-5">
アプリを遊んでいただきありがとうございます。<br/>
<br/>
このアプリの作成チームの<b>Tomoya’sDebater</b>です。<br/>
おかしいチーム名ですが、メンバー全員のネーミングセンスが無さすぎて、リーダーの名前とディベートを合わせて作りました。<br/>
<br/>
さて、ここではこのアプリを作ったプログラム言語とそのフレームワークについて少し話させてください。<br/>
まず我々は、PHPではなく、そのフレームワークであるLaravelという言語を使ってこのアプリを作りました。<br/>
フレームワークとは、一般的な機能やコードを自動的に追加することができ、開発工程を短縮することができる機能のことです。<br/>
<br/>
フレームワークを使うメリットは多くありますが、その分コードの勉強をPHPとは別に必要だったり、ファイルが複雑化してしまうなどのデメリットもありました。<br/>
<br/>
ですがLaravelはPHPのみよりも、できることが多く、世界的に見ても主流に使われています。そのような点から僕たちは今回初めてLaravelを触ってみました。<br/>
LaravelはPHPよりも、難しく複雑ですが、その分やりたいことを実現させるための機能も充実しています。<br/>
<br/>
プログラミングを今勉強されているならフレームワークの勉強もしてみてください。きっと役に立ちます。<br/>
<br/>
長い文章失礼しました。このアプリで遊んでいただく上での注意事項もありますので、読んでいただけると嬉しいです。<br/>
では、どうぞ皆さんでディベートを楽しんでください。<br/>
</div>
<hr>

<div class="mb-lg-4 mt-lg-4 mt-xxl-5">
<h1 class="alert-danger mb-5">注意事項</h1>
<div style="font-size: 1.5em" class="mb-5">
    <b>・発言者は三人以上入れません</b><br/>
    <b>・ルーム作成は1アカウントにつき最大３つです。※削除すれば新しく４つめを作ることができます</b><br/>
    <b>・アピールのため検閲範囲を少し厳しくしております</b><br/>
    <b>・攻撃的な発言や差別的な発言は検閲が入り、送信する事ができません</b><br/>
    <b>・通報やバグの報告・意見は下記のURLをクリック</b><br/>
</div>
</div>

<div class="mb-lg-4 mt-lg-4">
<h1 class="alert-info">遊び方</h1>
<div style="font-size: 1.2em">
１、まず新規登録（Registerから）でアカウントを作ってください<br/>
    （※１・２年生用にテストアカウントを作っております。クラスと出席番号がユーザー名、パスワードはユーザー名＋”password”で入れます。（（例）Aクラスの1番　ユーザー名：A01　パスワード：A01password）”）<br/>
２、登録した情報からログインしてください<br/>
３、カテゴリー画面からジャンルを選んでください<br/>
　※（政治・スポーツ・恋愛・芸能・食べ物・その他の６つから）<br/>
４、ジャンルにはそれぞれのお題があるので、選んでください<br/>
５、発表者と傍観者の立場を選んでください<br/>
６、発言者２人、傍観者１人以上の計３人以上が集まったらゲームが開始されます<br/>
７、タイマが終われば傍観者のみにどちらの意見に納得したか投票できます<br/>
８、結果がでて、試合終了です。トップページに戻ります<br/>
</div>
</div>
<div class="text-lg-center">
    <button type="submit" onclick="location.href='{{url('/login')}}'" class="btn btn-outline-primary btn-light p-xxl-5 m-lg-5 shadow-lg fs-4">ログイン</button>
    <button type="submit" onclick="location.href='{{url('/register')}}'" class="btn btn-outline-success btn-light p-xxl-5 m-lg-5 shadow-lg fs-4">アカウント作成</button>
</div>
@section('body')
@endsection
