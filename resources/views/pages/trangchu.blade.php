@extends('layout.index')

@section('content')

<!--========================== Contant-Area================================-->
<div class="contant-area">
    <div class="container" style="padding-bottom: 15px;">

        @include('layout.slide')
        <div class="row row-offcanvas row-offcanvas-left">
            <div class="col-md-3 col-sm-4 col-xs-6 sidebar-offcanvas" id="sidebar">
                <!--========================== left-sidebar ================================-->
                <div class="left-sidebar">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            @foreach($theloai as $tl)
                            @if(count($tl->loaitin) > 0)
                            <div class="panel-heading" role="tab" id="headingOne">

                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">{{$tl->Ten}}
                                        <i class="fa fa-angle-right"></i>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <ul>
                                        @foreach($tl->loaitin as $lt)
                                        <li><a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html">{{$lt->Ten}}</a></li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>

                    </div>
                </div><!-- left-sidebar -->
                <!-- left-sidebar -->
            </div>
            <!--========================== main-content ================================-->
            <div class="col-md-6 col-sm-8 col-xs-12">
                <div class="main-content">
                    @foreach($theloai as $tl)
                    @if(count($tl->loaitin) > 0)
                    <article>
                        
                        <h3>
                            <a >{{$tl->Ten}}</a>
                            <!-- @foreach($tl->loaitin as $lt)   
                            <small>
                                <a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html"><i>{{$lt->Ten}}</i></a>/
                            </small>
                            @endforeach -->
                        </h3>

                        <?php 
                        $data = $tl->tintuc->where('NoiBat',1)->sortByDesc(
                            'created_at')->take(5);
                        $tin1 = $data->shift();
                        ?>
                        <div class="post-img">
                            <a href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html" target="_blank"><img class="img-responsive" src="upload/tintuc/{{$tin1['Hinh']}}" alt="Post"/></a>
                        </div>
                        @foreach($tl->loaitin as $lt) 
                        <a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html" target="_blank" class="btn btn-default btn-sm btn-category" type="submit">{{$lt->Ten}}</a>
                        @endforeach
                        <a href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html" target="_blank"><h2 class="post-title">{{$tin1['TieuDe']}}</h2></a>
                        <div class="post-meta">
                            
                            <span><a ><i class="fa fa-calendar-check-o post-meta-icon"></i> {{$tin1['created_at']}}</a></span>
                        </div>
                        <div class="post-content">
                            <p>{{$tin1['TomTat']}}</p>
                        </div>
                    </article>
                    @endif
                    @endforeach
                    
                </div><!-- main-content -->
            </div>
            <!--========================== Right-Sidebar ================================-->
            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="right-sidebar">
                    <div class="righ-sidebar-body">
                        <div class="item">
                            <a ><h4 class="post-title slide-title">Tin phổ biến</h4></a>
                            @foreach($tinnoibat as $tt)
                            <div class="col-md-12 col-sm-6">
                                <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html"><img src="upload/tintuc/{{$tt->Hinh}}" alt="slider"></a>
                                <div class="carousel-caption">
                                    <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html"><h5 class="post-title">{{$tt['TieuDe']}}</h5></a>
                                    <div class="post-meta">
                                        <span><a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html"><i class="fa fa-calendar-check-o post-meta-icon"></i> {{$tt['created_at']}} </a></span>
                                    </div>
                                    <div class="post-content no-border">
                                        <p>{{$tt['TomTat']}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div><!-- Righ-sidebar-body -->
                </div><!-- Right-Sidebar -->
            </div>
        </div>
    </div><!-- Container -->
</div><!-- Content-area -->


@endsection