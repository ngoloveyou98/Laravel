<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'sanpham';
    public $timestamps = false;
    public function HoaDon()
    {
        return $this->hasMany('App\HoaDon','id_sp','id');
    }
}
