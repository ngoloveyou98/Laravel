@extends('layouts/main')

    @section('Subject')
    <ul>
        <li>PHP</li>
        <li>java</li>
    </ul>
    <p>
        @if($kh != '')
            {!!$kh!!}
        @else không có khóa học nào
        @endif
    </p>
    
    @if($tool != '')
        {{$tool}}
    @else 
        Ko ho tro tool
    @endif 

    <!-- --- -->
    <br>

    <ul> 
        @foreach($student as $st)
            <li>{!!$st . '<br>'!!}</li>
         @endforeach
    </ul>       

<!-- ----------------------- -->
    <!-- forelse -->
    <?php $khoahoc = array('PHP','lavarel','java') ?>

    @forelse($khoahoc as $khoa)
        @continue($khoa == 'PHP')
        
        {!!$khoa . '<br>'!!}
    @empty
        <p>arr empty</p>
    @endforelse



    
    @endsection


