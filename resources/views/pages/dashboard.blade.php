@extends('layouts.default')

@section('content')
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard Analytics</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <!-- page statustic card start -->
                <div class="row">
                    @role('admin')
{{--                    <div class="col-sm-4">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="row align-items-center">--}}
{{--                                    <div class="col-8">--}}
{{--                                        <h4 class="text-c-yellow">Rp. {{rupiah($earnings->saldo)}}</h4>--}}
{{--                                        <h6 class="text-muted m-b-0">All Earnings</h6>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-4 text-right">--}}
{{--                                        <i class="feather icon-bar-chart-2 f-28"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="card-footer bg-c-yellow">--}}
{{--                                <div class="row align-items-center">--}}
{{--                                    <div class="col-9">--}}
{{--                                        <a href="{{route('virtaul-account.show',Auth::user()->id)}}">--}}
{{--                                            <p class="text-white m-b-0">% change</p>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-3 text-right">--}}
{{--                                        <i class="feather icon-trending-up text-white f-16"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    @endrole
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h4 class="text-c-green">{{$pria}}</h4>
                                        <h6 class="text-muted m-b-0">Kosan Pria</h6>
                                    </div>
                                    <div class="col-4 text-right">
                                            <i class="feather icon-user f-28"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-c-green">
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <a href="{{route('kos-kosan.pria-index')}}">
                                            <p class="text-white m-b-0">% change</p>
                                        </a>
                                    </div>
                                    <div class="col-3 text-right">
                                        <i class="feather icon-trending-up text-white f-16"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h4 class="text-c-red">{{$wanita}}</h4>
                                        <h6 class="text-muted m-b-0">Kosan Wanita</h6>
                                    </div>
                                    <div class="col-4 text-right">
                                        <i class="feather icon-user f-28"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-c-red">
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <a href="{{route('kos-kosan.wanita-index')}}">
                                            <p class="text-white m-b-0">% change</p>
                                        </a>
                                    </div>
                                    <div class="col-3 text-right">
                                        <i class="feather icon-trending-down text-white f-16"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h4 class="text-c-blue">{{$campur}}</h4>
                                        <h6 class="text-muted m-b-0">Kosan Campur</h6>
                                    </div>
                                    <div class="col-4 text-right">
                                        <i class="feather icon-user f-28"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-c-blue">
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <a href="{{route('kos-kosan.campur-index')}}">
                                            <p class="text-white m-b-0">% change</p>
                                        </a>
                                    </div>
                                    <div class="col-3 text-right">
                                        <i class="feather icon-trending-down text-white f-16"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- page statustic card end -->
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
    @role('member')
    @if(!empty($check_sewa))
        @if($check_sewa == 0)
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-danger">Information Status Sewa Kos kosan</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <div class="row justify-content-center text-left">
                                            <p class="f-16"><strong>Kos Kosan</strong> Penyewaan online.</p>
                                            <p class="f-16"> Aplikasi  <strong>Kosan online yang mengunakan virtual account </strong></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
    @endif
    @endrole
@stop
