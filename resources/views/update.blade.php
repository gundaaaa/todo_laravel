@extends('layouts.todo')
@section('title','データ更新画面')
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
    <form method="POST" action="/update/{{$item->id}}">
        <table>
            @csrf
            <input type="hidden" name="id" value="{{$item->id}}">
            <tr>
                <th>name:</th>
                <td><input type='text' name="name" value="{{$item->name}}"></td>
            </tr>
            <tr>
                <th>message:</th>
                <td><input type="text" name="message" value="{{$item->message}}"></td>
            </tr>

            <input type="hidden" name="time" value="{{$item->time}}">
            <tr>
                <th>
                <td><input type="submit" value="更新"></td>
                </th>
            </tr>
        </table>
    </form>
    @endsection

</body>