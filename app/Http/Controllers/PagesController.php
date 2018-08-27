<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;

use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    //
    // Cứ gọi pagescontroller tự động truyền biến theloai
	function __construct()
	{
		$theloai = TheLoai::all();
		$slide = Slide::all();
		view()->share('theloai',$theloai);
		view()->share('slide',$slide);

		if(Auth::check())
		{
			view()->share('nguoidung',Auth::user());
		}
	}

    function trangchu()
    {
    	
    	return view('pages.trangchu');
    }

    function lienhe()
    {
    	
    	return view('pages.lienhe');
    }

    function loaitin($id)
    {
    	$loaitin = LoaiTin::find($id);
    	$tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
    	return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }

    function tintuc($id)
    {
    	$tintuc = TinTuc::find($id);
    	$tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
    	$tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
    	return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,
    		'tinlienquan'=>$tinlienquan]);
    }

    function getDangnhap()
    {
    	return view('pages.dangnhap');
    }

    function postDangnhap(Request $request)
    {
    	//Test nhận dữ liệu
    	// echo $request->email."<br>";
    	// echo $request->password;
    	$this->validate($request,
			[
				'email' => 'required',
				'password' => 'required|min:8|max:32'
			],
			[
				'email.required' => 'Bạn chưa nhập email của người dùng',
				'password.required' => 'Bạn chưa nhập mật khẩu của người dùng',
				'password.min' => 'Mật khẩu quá ngắn phải có ít nhất 8 ký tự',
				'password.max' => 'Mật khẩu quá dài chỉ được tối đa 32 ký tự',
			]
		);
		if(Auth::attempt(['email'=>$request->email, 
			'password'=>$request->password])) 
		{
			return redirect('trangchu');
		} 
		else 
		{
			return redirect('dangnhap')->with('thongbao', 'Bạn đăng nhập không thành công');
		}
    }

    function getDangxuat()
    {
    	Auth::logout();
    	return redirect('trangchu');
    }

    function Timkiem(Request $request)
    {
        $tukhoa = $request->tukhoa;
        // $tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orWhere('
        //     NoiDung','like',"%$tukhoa%")->take(30)->paginate(5);
        $tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->take(30)->paginate(5);
        return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }
}
