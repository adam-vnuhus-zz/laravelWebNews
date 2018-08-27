<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    //
    protected $table = "TheLoai";

    // lấy ra tất cả các loại tin có trong thể loai
    public function loaitin()
    {
    	return $this->hasMany('App\LoaiTin','idTheLoai','id');
    }

    public function tintuc()
    {
    	return $this->hasManyThrough('App\TinTuc','App\LoaiTin'
    		,'idTheLoai','idLoaiTin','id');
    }
}
