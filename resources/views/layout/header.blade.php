<header>
            <!--========================== Header-Top ================================-->
            <div class="header-top">
                <div class="container">
                    <div class="col-md-9 col-sm-7 xs-view">
                        <div class="search-section center-block">
                        <form action="timkiem" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="text" class="form-control" id="exampleInputName2" placeholder="Nhập từ khóa..." name="tukhoa" >
                                <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <!-- <a class="navbar-brand" href="trangchu">Tin Tức</a> -->
                    </div>
                    <div class="col-md-3 col-sm-5 xs-view-right" style="padding-top: 10px;">
                        <div class="search-section center-block">
                            
                            <!-- <form action="timkiem" method="POST" 
                                class="navbar-form navbar-left" role="search">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <input type="text" name="tukhoa" class="form-control" placeholder="Nhập từ khóa...">
                                </div>
                                <button type="submit" class="btn btn-default">Tìm kiếm</button>
                            </form> -->
                        </div>
                        <!-- Author -->

                        <ul class="nav navbar-nav pull-right">
                    @if(!(auth()->check()))

                        <li>
                            <a href="dangky">Đăng ký</a>
                        </li>
                        <li>
                            <a href="dangnhap">Đăng nhập</a>
                        </li>
                    @else

                        <li>
                            <a href="nguoidung">
                                <span class ="glyphicon glyphicon-user"></span>
                                {{auth()->user()->name}}
                            </a>
                        </li>

                        <li>
                            <a href="dangxuat">Đăng xuất</a>
                        </li>
                    @endif
                </ul>

                        
                    </div>
                </div>
            </div><!-- header-top -->
            
            <!--========================== Header-Nav ================================-->
            <div class="header-nav">
                <nav class="navbar navbar-default">
                    <div class="container">
                        <p class="pull-left visible-xs">
                            <button type="button" class="navbar-toggle" data-toggle="offcanvas">
                                <i class="fa fa-long-arrow-right"></i>
                                <i class="fa fa-long-arrow-left"></i>
                            </button>
                        </p>
                        <!-- <div class="social-nav center-block visible-xs">
                            <li><a href="#"><i class="fa fa-twitter twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus google-plus"></i></a></li>
                        </div> -->
                        <!--toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-left">
                                <li><a href="trangchu">home</a></li>
                                
                            </ul>
                            <!-- <ul class="nav navbar-nav navbar-right hidden-xs">
                                <li><a href="https://twitter.com/"><i class="fa fa-twitter twitter"></i></a></li>
                                <li><a href="https://facebook.com/"><i class="fa fa-facebook facebook"></i></a></li>
                                <li><a href="https://google.com/"><i class="fa fa-google-plus google-plus"></i></a></li>
                            </ul> -->
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-->
                </nav>
            </div><!-- Header-Nav -->
        </header>


