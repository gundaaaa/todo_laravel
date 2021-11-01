<!DOCTYPE html>
<html lang="ja">

<head>
    @include('coom.head')
    <title>@yield('title')</title>
</head>

<body>
    <h1 class="title">@yield('title')</h1>
    <div class="label"></div>
    <div class="textarea">
        @section('menubar')
        @show
    </div>
    @yield('text')
    </div>
    <div class="footer">
        @yield('footer')
    </div>
</body>

</html>