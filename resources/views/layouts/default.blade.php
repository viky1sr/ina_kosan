<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.include.meta-dashboard')
    @yield('style-page')
    @toastr_css
</head>
<body class="">
<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->
<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar menu-light ">
  @include('layouts.include.side-bar-dashboard')
</nav>
<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
    @include('layouts.include.header-dashboard')
</header>
<!-- [ Header ] end -->

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    @yield('content')
</div>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="text-center">
                        <h3 class="mt-3">Welcome To <span class="text-primary">Kos Kosan</span><sup></sup></h3>
                    </div>
                    <div class="carousel-inner text-center">
                        <div class="carousel-item active" data-interval="50000">
                            <img src="{{asset('assets/images/model/welcome.svg')}}" class="wid-250 my-4" alt="images">
                            <div class="row justify-content-center">
                                <div class="col-lg-9">
                                    <p class="f-16"><strong>Kos Kosan</strong> Penyewaan online.</p>
                                    <p class="f-16"> Aplikasi  <strong>Kosan online yang mengunakan virtual account </strong></p>
                                    <div class="row justify-content-center text-left">
                                        <div class="col-md-10">
                                            <h4 class="mb-3">Fasilitas</h4>
                                            <p class="mb-2 f-16"><i class="feather icon-check-circle mr-2 text-primary"></i>AC</p>
                                            <p class="mb-2 f-16"><i class="feather icon-check-circle mr-2 text-primary"></i> TV</p>
                                            <p class="mb-2 f-16"><i class="feather icon-check-circle mr-2 text-primary"></i> WIFI</p>
                                            <p class="mb-2 f-16"><i class="feather icon-check-circle mr-2 text-primary"></i>Dll.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
<!-- Required Js -->
@include('layouts.include.plugins-dashboard')

@yield('script-page')

</body>
@toastr_js
@toastr_render
</html>
