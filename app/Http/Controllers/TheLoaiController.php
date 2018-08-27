<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
class TheLoaiController extends Controller
{
    //
    public function getDanhSach()
    {
    	// Khai bao bien theloai
    	$theloai = TheLoai::all();
    	return view('admin.theloai.danhsach',['theloai'=>$theloai]
    		);
    }

    public function getThem()
    {
    	//Goi trang them ra
    	return view('admin.theloai.them');
    }

    // Nhan du lieu luu vao csdl
    public function postThem(Request $request)
    {
    	// test xem ham chay chua
    	// echo $request->Ten;
    	// check kiem tra cac loi khi gui
    	$this->validate($request,
    		[
    			'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100'
    		],
    		[
    			'Ten.required' => 'Bạn chưa nhập thể loại',
    			'Ten.unique' => 'Tên thể loại đã tồn tại',
    			'Ten.min' => 'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự',
    			'Ten.max' => 'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự'
    		]
    	);
    	
    	// Bat loi xong lay ten luu vao modal the loai
    	$theloai = new TheLoai;
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	// check loi
    	// echo changeTitle($request->Ten);
    	$theloai->save();
    	// thêm xong trả về trang thêm
    	return redirect('admin/theloai/them')->with('thongbao',
    		'Thêm thành công');
    }

    public function getSua($id)
    {
    	//Tim cai the loai có id truyền vào
    	$theloai = TheLoai::find($id);
    	// Tim xong truyen thong sang trang sua để hiện thị
    	return view('admin.theloai.sua',['theloai'=>$theloai]);
    }

    public function postSua(Request $request, $id)
    {
    	$theloai = TheLoai::find($id);
    	$this->validate($request,
    		// Hien thi cac dieu kiện lỗi
    		[
    			'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100'
    		],
    		// Các thông báo lỗi
    		[
    			'Ten.required' => 'Bạn chưa nhập tên thể loại',
    			'Ten.unique' => 'Tên thể loại đã tồn tại',
    			'Ten.min' => 'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự',
    			'Ten.max' => 'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự'
    		]
    	);
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();
    	return redirect('admin/theloai/sua/'.$id)->with('thongbao',
    		'Sửa thành công');
    }

    public function getXoa($id)
    {
		$theloai = TheLoai::find($id);
		$theloai->delete();

		return redirect('admin/theloai/danhsach')->with('thongbao',
    		'Bạn đã xóa thành công');
    }
}
?>