<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    @include('layouts.header')
    <div id="content">
        <h1>Môn học: </h1>
        @yield('Subject')
    </div>

    @include('layouts.footer')
</body>
</html>