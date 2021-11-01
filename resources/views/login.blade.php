@extends('layouts.todo')
@section('title','login画面')

<body>
    @section('menubar')
    <form action="login" method="post">
        @csrf
        <div>
            <label>ユーザーID<label>
                    <input type="text" name="name" value="{{old('name')}}" required>
        </div>
        <div>
            <label>メールアドレス<label>
                    <input type="text" name="mail" value="{{old('mail')}}" required>
        </div>
        <div>
            <label>パスワード<label>
                    <input type="password" name="pass" value="{{old('password')}}" required>
        </div>
        <input type="submit" value="ログイン">
    </form>
    <p>{{$msg}}</p>
    @if($link)
    <a href="/sin">登録されてない方は新規登録へ</a>
    @endif
    @endsection
</body>