<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\khachhang;
use Illuminate\Pagination\Paginator;

class TinController extends Controller

{
    public function index()
    {
        $kh = khachhang::paginate(3);
        // ->simplePaginate(3)
        // paginate
        return view('listKH',['kh'=>$kh]);

    }
}
