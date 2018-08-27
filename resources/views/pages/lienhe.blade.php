@extends('layout.index')

@section('content')
<!-- Page Content -->
<div class="container">

	@include('layout.slide')

	<div class="space20"></div>


	<div class="row main-left">
		@include('layout.menu')

		<div class="col-md-9">
			<div class="panel panel-default">            
				<div class="panel-heading" style="background-color:#337AB7; color:white;" >
					<h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
				</div>

				<div class="panel-body">
					<!-- item -->
					<h3><span class="glyphicon glyphicon-align-left"></span> Thông tin liên hệ</h3>

					<div class="break"></div>
					<h4><span class= "glyphicon glyphicon-home "></span> Địa chỉ : </h4>
					

					<h4><span class="glyphicon glyphicon-envelope"></span> Email : </h4>
					
					<h4><span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : </h4>
					



					<br><br>
					<h3><span class="glyphicon glyphicon-globe"></span> Bản đồ</h3>
					<div class="break"></div><br>
					<iframe src="https://www.google.com/maps/place/330+Nguy%E1%BB%85n+Tr%C3%A3i,+Thanh+Xu%C3%A2n+Trung,+Thanh+Xu%C3%A2n,+H%C3%A0+N%E1%BB%99i,+Vietnam/@20.9960725,105.80909,21z/data=!4m18!1m12!4m11!1m3!2m2!1d105.8083027!2d20.9963088!1m6!1m2!1s0x3135acbf0df2c0e5:0xd740a66998e1a0ed!2zxJHhuqFpIGjhu41jIGtob2EgaOG7jWMgdOG7sSBuaGnDqm4gZ29vZ2xlIG1hcA!2m2!1d105.807959!2d20.996017!3m4!1s0x3135ac96f04789b9:0xb28f5b5b310d44fd!8m2!3d20.9960525!4d105.8091473" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
</div>
<!-- end Page Content -->

@endsection