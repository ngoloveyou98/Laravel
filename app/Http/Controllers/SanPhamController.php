<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SanPham;

class SanPhamController extends Controller
{
    public function getAll()
    {
        $sanpham = SanPham::where('soluong','>',4)->get();
        foreach($sanpham as $sp){
            echo "Tên sp: $sp->tenSP <br>
                   so luong:  $sp->soluong <hr>";
            
        }
    }
    public function getForm()
    {
        return view('pages.findProducts');
    }
    public function postfind(Request $request)
    {
        $sanpham = SanPham::where('tensp','like',"%$request->nameProduct%")->orderBy('soluong','desc')->get();
        if(isset($sanpham)){
            foreach($sanpham as $sp){
                echo "Tên sản phẩm: $sp->tenSP <br>
                        Số lượng: $sp->soluong <hr>";
            }
        }else echo  "không có kết quả cho "."\" $request->nameProduct\" ";
    }

    //lienket
    public function lkHoaDon()
    {
        $sanpham = SanPham::find(1)->HoaDon->toArray();
        var_dump($sanpham);
    }

}
