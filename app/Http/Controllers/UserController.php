<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    //
	public function getDanhSach()
	{
    	// Khai bao bien theloai
		$user = User::all();
		return view('admin.user.danhsach',['user'=>$user]);
	}

	public function getThem()
	{
    	//Goi trang them ra trong view admin
		return view('admin.user.them');
	}

    // Nhan du lieu luu vao csdl
	public function postThem(Request $request)
	{
    	// test xem ham chay chua
    	// echo $request->Ten;
    	// check kiem tra cac loi khi gui
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
		$user->quyen = $request->quyen;
    	// check loi
    	// echo changeTitle($request->Ten);
		$user->save();
		return redirect('admin/user/them')->with('thongbao','Bạn đã thêm người dùng thành công');
	}

	public function getSua($id)
	{
    	//Tim cai the loai có id truyền vào
		$user = User::find($id);
    	// Tim xong truyen thong sang trang sua để hiện thị
		return view('admin.user.sua',['user'=>$user]);
	}

	public function postSua(Request $request, $id)
	{
    	// test xem ham chay chua
    	// echo $request->Ten;
    	// check kiem tra cac loi khi gui
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
		$user = User::find($id);
		$user->name = $request->name;
		$user->quyen = $request->quyen;

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
		return redirect('admin/user/sua/'.$id)->with('thongbao','Bạn đã sửa thông tin người dùng thành công');
	}

	public function getXoa($id)
	{
		$user = User::find($id);
		$user->delete();

		return redirect('admin/user/danhsach')->with('thongbao',
			'Bạn đã xóa người dùng thành công');
	}

	public function getDangnhapAdmin()
	{
		return view('admin.login');
	}

	public function postDangnhapAdmin(Request $request)
	{
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
			return redirect('admin/theloai/danhsach');
		} 
		else 
		{
			return redirect('admin/dangnhap')->with('thongbao', 'Bạn đăng nhập không thành công');
		}
	}

	public function getDangXuatAdmin()
	{
		Auth::logout();
		return redirect('admin/dangnhap');
	}
}
?>
