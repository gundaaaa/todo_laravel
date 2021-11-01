@extends('layouts.todo')
@section('title','管理者画面')

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
    @foreach ($item as $items)
    <form>
        <table>


            <tr>
                <th>更新</th>
                <th>削除</th>
                <th>name</th>
                <th>message</th>
                <th>time</th>
            </tr>
            <tr>
                <td><a href="/update/{{$items->id}}">更新</a></td>
                <td><a href="/delete/{{$items->id}}">削除</a></td>
                <!-- ⇓の書き方はinputを使った際の書き方 -->
                <!-- <td><input type="submit" name='id' value="{{$items->id}}"></td> -->
                <td>{{$items->name}}</td>
                <td>{{$items->message}}</td>
                <td>{{$items->time}}</td>
            </tr>
        </table>
    </form>
    @endforeach
    @endsection

    @section('footer')
    <a href="/research">検索画面へ</a>
    @endsection
</body>
<!-- <input type='button' value='スタート' onclick="location.href='quiz?id=1'"></input> -->