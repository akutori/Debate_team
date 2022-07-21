@extends('header')

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gentium+Plus:ital@1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">　
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/genre.css')}}">
    <link rel="stylesheet" href="{{asset('js/genre.js')}}">

@endsection
<h1>始めにお読みください</h1>
アプリを遊んでいただきありがとうございます。<br/>
<br/>
このアプリの作成チームのTomoya’sDebaterです。<br/>
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

<h1>注意事項</h1>
・朝8時30分〜9時30分の間はプレイしないでください

<h1>遊び方</h1>
１、まず新規登録（Registerから）でアカウントを作ってください<br/>
２、登録した情報からログインしてください<br/>
３、カテゴリー画面からジャンルを選んでください<br/>
　※（政治・スポーツ・恋愛・芸能・食べ物・その他の６つから）<br/>
４、ジャンルにはそれぞれのお題があるので、選んでください<br/>
５、発表者と傍観者の立場を選んでください<br/>
６、発表者が２人、傍観者１人の計３人集まったらディベートが開始されます<br/>
７、タイマが終われば傍観者のみにどちらの意見に納得したか投票できます<br/>
８、結果がでて、試合終了です。トップページに戻ります<br/>
