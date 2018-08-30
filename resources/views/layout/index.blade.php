<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tuan Anh | @yield('title')</title>
    <!-- Thêm vào để không mất file css -->
    <base href="{{asset('')}}">
    <!-- Bootstrap Core CSS -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">

    
    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- <title>:: Author ::</title> -->

    <!-- Bootstrap -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800' rel='stylesheet' type='text/css'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="css/offcanvas.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
	<!-- Nhúng css -->
	@yield('css')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="padding: 0">

    @include('layout.header')

    @yield('content')

    @include('layout.footer')
    <!-- jQuery -->
    <!-- <script src="js/jquery.js"></script> -->
    <!-- Bootstrap Core JavaScript -->

    <!-- <script src="js/bootstrap.min.js"></script>
    <script src="js/my.js"></script> -->
    
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src ="js/custom.js"></script>
    </script>
	<!-- Nhúng script -->
	@yield('script')
</body>

</html>
