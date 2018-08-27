<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

//gop nhom cac route lien quan den admin

	//Bỏ ngoài trang admin vì trang đăng nhập cần vào đầu tiên
Route::get('admin/dangnhap','UserController@getDangnhapAdmin');
Route::post('admin/dangnhap','UserController@postDangnhapAdmin');
Route::get('admin/dangxuat','UserController@getDangXuatAdmin');

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'], function()
{
	Route::group(['prefix'=>'theloai'],function(){
		// admin/theloai/them
		Route::get('danhsach','TheLoaiController@getDanhSach');

		// Goi trang sua de sua
		Route::get('sua/{id}','TheLoaiController@getSua');
		// Tu form truyên lên route postSua
		Route::post('sua/{id}','TheLoaiController@postSua');

		Route::get('them','TheLoaiController@getThem');
		Route::post('them','TheLoaiController@postThem');

		Route::get('xoa/{id}','TheLoaiController@getXoa');
	});

	Route::group(['prefix'=>'loaitin'],function(){
		// admin/loaitin/them
		Route::get('danhsach','LoaiTinController@getDanhSach');

		// Goi trang sua de sua
		Route::get('sua/{id}','LoaiTinController@getSua');
		// Tu form truyên lên route postSua
		Route::post('sua/{id}','LoaiTinController@postSua');

		Route::get('them','LoaiTinController@getThem');
		Route::post('them','LoaiTinController@postThem');

		Route::get('xoa/{id}','LoaiTinController@getXoa');
	});

	Route::group(['prefix'=>'tintuc'],function(){
		// admin/tintuc/them
		Route::get('danhsach','TinTucController@getDanhSach');

		Route::get('sua/{id}','TinTucController@getSua');
		Route::post('sua/{id}','TinTucController@postSua');

		Route::get('them','TinTucController@getThem');
		Route::post('them','TinTucController@postThem');

		Route::get('xoa/{id}','TinTucController@getXoa');
	});

	Route::group(['prefix'=>'comment'],function(){
		
		Route::get('xoa/{id}/{idTinTuc}','CommentController@getXoa');
	});

	Route::group(['prefix'=>'slide'],function(){
		Route::get('danhsach','SlideController@getDanhSach');

		Route::get('sua/{id}','SlideController@getSua');
		Route::post('sua/{id}','SlideController@postSua');

		Route::get('them','SlideController@getThem');
		Route::post('them','SlideController@postThem');

		Route::get('xoa/{id}','SlideController@getXoa');
	});

	Route::group(['prefix'=>'ajax'],function()
	{
		Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
	});

	Route::group(['prefix'=>'user'],function(){
		Route::get('danhsach','UserController@getDanhSach');

		Route::get('sua/{id}','UserController@getSua');
		Route::post('sua/{id}','UserController@postSua');

		Route::get('them','UserController@getThem');
		Route::post('them','UserController@postThem');

		Route::get('xoa/{id}','UserController@getXoa');
	});
});

Route::get('trangchu','PagesController@trangchu');
// Test rout trangchu
// Route::get('trangchu',function()
// {
// 	return view('pages.trangchu');
// })

Route::get('lienhe','PagesController@lienhe');

Route::get('loaitin/{id}/{TenKhongDau}.html','PagesController@loaitin');

Route::get('tintuc/{id}/{TieuDeKhongDau}.html','PagesController@tintuc');

// Trang quan ly nguoi dung
Route::get('nguoidung','PagesController@getNguoidung');
Route::post('nguoidung','PagesController@postNguoidung');

// Đăng nhập cho client
Route::get('dangnhap','PagesController@getDangnhap');
Route::post('dangnhap','PagesController@postDangnhap');
Route::get('dangxuat','PagesController@getDangxuat');

// Đăng ký
Route::get('dangky','PagesController@getDangky');
Route::post('dangky','PagesController@postDangky');

// Bình luận
Route::post('comment/{id}','CommentController@postComment');

// Tìm kiếm
Route::post('timkiem','PagesController@Timkiem');

?>