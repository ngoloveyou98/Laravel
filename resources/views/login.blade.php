<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     
     {{-- {{ $er ?? "" }} --}} 
    <form action="{{route("login")}}" method="post">
        @csrf <!-- {{ csrf_field() }} -->
        <input type="text" name="username" placeholder="nhập username"><br> 
        <input type="password" name="password" placeholder="nhập password" ><br>
        <input type="submit" value="đăng nhập"><br>
        {{ isset($er) ? $er: '' }}
    </form>
    
        
    
</body>
</html>