<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Slide;

class SlideController extends Controller
{
    //
	public function getDanhSach()
	{
    	// Khai bao bien theloai
		$slide = Slide::all();
		return view('admin.slide.danhsach',['slide'=>$slide]);
	}

	public function getThem()
	{
    	//Goi trang them ra
		return view('admin.slide.them');
	}

    // Nhan du lieu luu vao csdl
	public function postThem(Request $request)
	{
    	// test xem ham chay chua
    	// echo $request->Ten;
    	// check kiem tra cac loi khi gui
		$this->validate($request,
			[
				'Ten' => 'required',
				'NoiDung' => 'required'
			],
			[
				'Ten.required' => 'Bạn chưa nhập tên của slide',
				'NoiDung.required' => 'Bạn chưa nhập nội dung'
			]
		);

    	// Bat loi xong lay ten luu vao modal the loai
		$slide = new Slide;
		$slide->Ten = $request->Ten;
		$slide->NoiDung = $request->NoiDung;
    	// check loi
    	// echo changeTitle($request->Ten);

		if($request->has('link'))
			$slide->link = $request->link;
		if($request->hasFile('Hinh'))
		{
			$file = $request->file('Hinh');
			$duoi = $file->getClientOriginalExtension();
			if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
			{
				return redirect('admin/slide/them')->with('loi',
					'Bạn chỉ được chọn file có đuôi jpg, png, jpeg');
			}
			$name = $file->getClientOriginalName();
            // Ten hình ngẫu nhiên
			$Hinh = str_random(6)."_". $name;
			while (file_exists("upload/slide/".$Hinh)) 
			{
				$Hinh = str_random(6)."_". $name;
			}
			$file->move("upload/slide",$Hinh);
			$slide->Hinh = $Hinh;
		}
		else
		{
			$slide->Hinh = "";
		}

		$slide->save();
		return redirect('admin/slide/them')->with('thongbao','Thêm slide thành công');
	}

	public function getSua($id)
	{
    	//Tim cai the loai có id truyền vào
		$slide = Slide::find($id);
    	// Tim xong truyen thong sang trang sua để hiện thị
		return view('admin.slide.sua',['slide'=>$slide]);
	}

	public function postSua(Request $request, $id)
	{
    	// test xem ham chay chua
    	// echo $request->Ten;
    	// check kiem tra cac loi khi gui
		$this->validate($request,
			[
				'Ten' => 'required',
				'NoiDung' => 'required'
			],
			[
				'Ten.required' => 'Bạn chưa nhập tên của slide',
				'NoiDung.required' => 'Bạn chưa nhập nội dung'
			]
		);

    	// Bat loi xong lay ten luu vao modal the loai
		$slide = Slide::find($id);
		$slide->Ten = $request->Ten;
		$slide->NoiDung = $request->NoiDung;
    	// check loi
    	// echo changeTitle($request->Ten);

		if($request->has('link'))
			$slide->link = $request->link;
		if($request->hasFile('Hinh'))
		{
			$file = $request->file('Hinh');
			$duoi = $file->getClientOriginalExtension();
			if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
			{
				return redirect('admin/slide/them')->with('loi',
					'Bạn chỉ được chọn file có đuôi jpg, png, jpeg');
			}
			$name = $file->getClientOriginalName();
            // Ten hình ngẫu nhiên
			$Hinh = str_random(6)."_". $name;
			while (file_exists("upload/slide/".$Hinh)) 
			{
				$Hinh = str_random(6)."_". $name;
			}
			unlink("upload/slide/".$slide->Hinh);
			$file->move("upload/slide",$Hinh);
			$slide->Hinh = $Hinh;
		}
		$slide->save();
		return redirect('admin/slide/sua/'.$id)->with('thongbao','Sửa slide thành công');
	}

	public function getXoa($id)
	{
		$slide = Slide::find($id);
		$slide->delete();

		return redirect('admin/slide/danhsach')->with('thongbao',
			'Bạn đã xóa thành công');
	}
}
?>
