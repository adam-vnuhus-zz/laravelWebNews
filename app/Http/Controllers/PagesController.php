<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use App\User;

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

    function getDangky()
    {
        return view('pages.dangky');
    }

    function postDangky(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:5',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|max:32',
                'passwordAgain' => 'required|same:password'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên của người dùng',
                'name.min' => 'Tên người dùng phải có ít nhất 5 ký tự',
                'email.required' => 'Bạn chưa nhập email của người dùng',
                'email.email' => 'Bạn chưa nhập đúng định dạng của email',
                'email.unique' => 'Email của bạn đã tồn tại, hãy nhập lại',
                'password.required' => 'Bạn chưa nhập mật khẩu của người dùng',
                'password.min' => 'Mật khẩu quá ngắn phải có ít nhất 8 ký tự',
                'password.max' => 'Mật khẩu quá dài chỉ được tối đa 32 ký tự',
                'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu của người dùng',
                'passwordAgain.same' => 'Bạn nhập lại mật khẩu chưa khớp'
            ]
        );

        // Bat loi xong lay ten luu vao modal the loai
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        // Mã hóa mật khẩu bằng bcrypt
        $user->password = bcrypt($request->password);
        $user->quyen = 0;
        // check loi
        // echo changeTitle($request->Ten);
        $user->save();
        return redirect('dangky')->with('thongbao','Bạn đã đăng ký thành công');
    }

    function getNguoidung()
    {
        $user = Auth::user();
        return view('pages.nguoidung',['nguoidung'=>$user]);
    }

    function postNguoidung(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:5'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên của người dùng',
                'name.min' => 'Tên người dùng phải có ít nhất 5 ký tự'
            ]
        );

        // Bat loi xong lay ten luu vao modal the loai
        $user = Auth::user();
        $user->name = $request->name;


        if($request->changePassword == "on")
        {
            $this->validate($request,
                [
                    'password' => 'required|min:8|max:32',
                    'passwordAgain' => 'required|same:password'
                ],
                [
                    'password.required' => 'Bạn chưa nhập mật khẩu của người dùng',
                    'password.min' => 'Mật khẩu quá ngắn phải có ít nhất 8 ký tự',
                    'password.max' => 'Mật khẩu quá dài chỉ được tối đa 32 ký tự',
                    'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu của người dùng',
                    'passwordAgain.same' => 'Bạn nhập lại mật khẩu chưa khớp'
                ]
            );
            // Mã hóa mật khẩu bằng bcrypt
            $user->password = bcrypt($request->password);
        }
        // check loi
        // echo changeTitle($request->Ten);
        $user->save();
        return redirect('nguoidung')->with('thongbao','Bạn đã sửa thông tin người dùng thành công');
    }
}
