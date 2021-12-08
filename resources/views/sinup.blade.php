@extends('layouts.todo')
@section('title','商品向上アンケート')
<style>
 form {
     background-image: url(../icon/StockSnap_C7LDIUGZ9K.jpg);
    background-size: contain;
 }

</style>

<body>
    @section('menubar')
    <!-- 内容が空欄だった場合 -->
    @if (count($errors) > 0)
    <p>入力に問題があります。再入力してください。</p>
    @endif
    <form method="POST" action="/sinup">
        <tabel>
            @csrf

            <label for="message">ニックネーム</label>
            @error('msg')
            <tr>
                <th>ERROR</th>
                <td>{{$message}}</td>
            </tr>
            @enderror
            <div>
                <tr>
                    <td><input type="text" name="msg" value="{{old('msg')}}"></td>
                </tr>
            </div>

            <label for="message">内容</label>
            @error('mmm')
            <tr>
                <th>ERROR</th>
                <td>{{$message}}</td>
            </tr>
            @enderror
            <div>
                <!-- <input type="text" name="mmm" value=""> -->
                <textarea id="message" name="mmm" value="{{old('mmm')}}"></textarea>
            </div>
            <div>
                <input type="submit" id="myfunc" value="送信ボタン">
            </div>
        </tabel>
        <script>
            'use strict';
            const myfunc = document.getElementById("myfunc");
            myfunc.addEventListener("click", function() {
                alert('この内容で本当によろしいでしょうか？');
            });
        </script>
    </form>
    <!-- <img class="picture" src="/icon/StockSnap_C7LDIUGZ9K.jpg" alt=""> -->

    <p>件名:{{$msg}}</p>
    <P>内容:{{$mmm}}</P>



    @endsection

    @section('footer')
    2021 商品向上アンケート
    @endsection
</body>