@extends('layouts.todo')
@section('title','管理者検索画面')

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
    @foreach ((array)$id as $id)
    @foreach ((array)$name as $name)
    @foreach ((array)$message as $message)
    <form>
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
                <td><a href="/update/{{$id}}">更新</a></td>
                <td><a href="/delete/{{$id}}">削除</a></td>
                <td>{{$id}}</td>
                <td>{{$name}}</td>
                <td>{{$message}}</td>
                <td>{{$time}}</td>
            </tr>
        </table>
    </form>
    @endforeach
    @endforeach
    @endforeach
    @endsection

</body>
<!-- <input type='button' value='スタート' onclick="location.href='quiz?id=1'"></input> -->