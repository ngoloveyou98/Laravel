<style>
    .pagination li{
        list-style: none;
        float: left;
        margin-left: 5px;
     }

</style>

@foreach ($kh as $item)
    "Họ Tên: {{ $item->HoTen }}"<br>
    "Address: {{ $item->Address }}"<br>
    <hr>

@endforeach
{!!$kh->links()!!}