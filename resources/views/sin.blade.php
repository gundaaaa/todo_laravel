@extends('layouts.todo')
@section('title','新規登録画面')
<body>
    @section('menubar')
    <!-- //処理を行う宛先を指定 -->
    <form action="sin" method="post">
        @csrf
        <div>
            <label>ユーザーID<label>
                    <input type="text" name="name" value="" required>
        </div>
        <div>
            <label>メールアドレス<label>
                    <input type="text" name="mail" value="〇〇〇〇" required>
        </div>
        <div>
            <label>パスワード<label>
                    <input type="password" name="pass" value="〇〇〇" required>
        </div>
        <input type="submit" value="新規登録">
    </form>
    <!--メッセージの出力-->
    <p>{{$msg}}</p>
    <!--下はコントローラーに$linkで中身が存在した場合、下記の物を表示する。-->
    @if($link)
    <a href="/login">ログインページ</a>
    @endif
    <p>すでに登録済みの方は<a href="login">こちら</a></p>
    @endsection
</body>