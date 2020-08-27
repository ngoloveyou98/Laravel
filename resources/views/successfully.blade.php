@if(Auth::check())
    <h1>đăng nhập thành công</h1>
    <a href="{{url("logout")}}">Logout</a>
@else 
    <h1>Bạn chưa đăng nhập</h1>
@endif