<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TinTuc;
use App\TheLoai;
use App\LoaiTin;
use App\Comment;

class TinTucController extends Controller
{
    //
    public function getDanhSach()
    {
    	// Khai bao bien theloai
    	$tintuc = TinTuc::orderBy('id', 'DESC')->get();
    	return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }

    public function getThem()
    {
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();
    	//Goi trang them ra
    	return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    // Nhan du lieu luu vao csdl
    public function postThem(Request $request)
    {
    	// test xem ham chay chua
    	// echo $request->Ten;
    	// check kiem tra cac loi khi gui
    	$this->validate($request,
    		[
    			'LoaiTin' => 'required',
                'TieuDe' => 'required|unique:TinTuc,TieuDe|min:3',
                'TomTat' => 'required',
                'NoiDung' => 'required'
    		],
    		[
    			'LoaiTin.required' => 'Bạn chưa chọn được loại tin',
                'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
    			'TieuDe.unique' => 'Tiêu đề đã tồn tại',
    			'TieuDe.min' => 'Tiêu đề phải có ít nhất 3 ký tự',
    			'TomTat.required' => 'Bạn chưa nhập tóm tắt',
                'NoiDung.required' => 'Bạn chưa nhập nội dung',
    		]
    	);
    	
    	// Bat loi xong lay ten luu vao modal the loai
    	$tintuc = new TinTuc;
    	$tintuc->TieuDe = $request->TieuDe;
    	$tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0;
    	// check loi
    	// echo changeTitle($request->Ten);

        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/tintuc/them')->with('loi',
                    'Bạn chỉ được chọn file có đuôi jpg, png, jpeg');
            }
            $name = $file->getClientOriginalName();
            // Ten hình ngẫu nhiên
            $Hinh = str_random(6)."_". $name;
            while (file_exists("upload/tintuc/".$Hinh)) 
            {
                $Hinh = str_random(6)."_". $name;
            }
            $file->move("upload/tintuc",$Hinh);
            $tintuc->Hinh = $Hinh;
        }
        else
        {
            $tintuc->Hinh = "";
        }

    	$tintuc->save();
    	// thêm xong trả về trang thêm
    	return redirect('admin/tintuc/them')->with('thongbao',
    		'Bạn đã thêm tin thành công');
    }

    public function getSua($id)
    {
    	//Tim cai the loai có id truyền vào
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
    	$tintuc = TinTuc::find($id);
    	// Tim xong truyen thong sang trang sua để hiện thị
    	return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function postSua(Request $request, $id)
    {
    	$tintuc = TinTuc::find($id);
    	$this->validate($request,
            [
                'LoaiTin' => 'required',
                'TieuDe' => 'required|unique:TinTuc,TieuDe|min:3',
                'TomTat' => 'required',
                'NoiDung' => 'required'
            ],
            [
                'LoaiTin.required' => 'Bạn chưa chọn được loại tin',
                'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
                'TieuDe.unique' => 'Tiêu đề đã tồn tại',
                'TieuDe.min' => 'Tiêu đề phải có ít nhất 3 ký tự',
                'TomTat.required' => 'Bạn chưa nhập tóm tắt',
                'NoiDung.required' => 'Bạn chưa nhập nội dung',
            ]
        );
    	
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
       
        // check loi
        // echo changeTitle($request->Ten);

        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/tintuc/them')->with('loi',
                    'Bạn chỉ được chọn file có đuôi jpg, png, jpeg');
            }
            $name = $file->getClientOriginalName();
            // Ten hình ngẫu nhiên
            $Hinh = str_random(6)."_". $name;
            while (file_exists("upload/tintuc/".$Hinh)) 
            {
                $Hinh = str_random(6)."_". $name;
            }
            unlink("upload/tintuc/".$tintuc->Hinh);
            $file->move("upload/tintuc",$Hinh);
            $tintuc->Hinh = $Hinh;
        }

        $tintuc->save();
    	return redirect('admin/tintuc/sua/'.$id)->with('thongbao',
    		'Bạn đã sửa thành công');
    }

    public function getXoa($id)
    {
		$tintuc = TinTuc::find($id);
		$tintuc->delete();

		return redirect('admin/tintuc/danhsach')->with('thongbao',
    		'Bạn đã xóa thành công');
    }
}
?>
