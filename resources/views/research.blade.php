@extends('layouts.todo')
@section('title','検索画面')
<style>
    th {
        background-color: #999;
        color: black;
        padding: 5px 10px;
    }

    td {
        border: solid 1px #aaa;
        color: #999;
        padding: 5px 10px;
    }
</style>

<body>
    @section('menubar')
    <!-- //処理を行う宛先を指定 -->
    <form action="research" method="post">
        @csrf
        <div>
            <label>ID検索:<input type="text" name="research" value=" " required></label>
        </div>
        <div>
            <label>NAME検索:<input type="text" name="name" value=" " required></label>
        </div>
        <div>
            <label>日付検索:<input type="text" name="time" value=" " required></label>
        </div>
        <input type="submit" value="検索">

    </form>
    <!--メッセージの出力-->

    <P>{{$msg}}</P>
    <!--下は$itemの中身が存在した場合、下記の物を表示する。-->
    @if($item)
    @foreach($item as $items)
    <table>
        <tr>
            <th>更新</th>
            <th>削除</th>
            <th>id</th>
            <th>name</th>
            <th>message</th>
            <th>time</th>
        </tr>
        <tr>
            <td><a href="/update/{{$items->id}}">更新</a></td>
            <td><a href="/delete/{{$items->id}}">削除</a></td>
            <td>{{$items->id}}</td>
            <td>{{$items->name}}</td>
            <td>{{$items->message}}</td>
            <td>{{$items->time}}</td>
        </tr>
    </table>
    </form>
    @endforeach
    @else
    <p>データを検索をお願いします。</p>
    @endif


    @endsection

    @section('footer')
    <a href="/data">管理者画面</a>
    @endsection
</body>