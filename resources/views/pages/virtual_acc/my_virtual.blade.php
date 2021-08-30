@extends('layouts.default')

@section('style-page')
@stop

@section('content')
    <div class="pcoded-content">
        <div class="user-profile user-card mb-4">
            <div class="card-header border-0 p-0 pb-0">
                <div class="cover-img-block">
                    <!-- <img src="assets/images/profile/cover.jpg" alt="" class="img-fluid"> -->
                    <div class="overlay"></div>
                    <div class="change-cover">
                        <div class="dropdown">
                            <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon feather icon-camera"></i></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"><i class="feather icon-upload-cloud mr-2"></i>upload new</a>
                                <a class="dropdown-item" href="#"><i class="feather icon-image mr-2"></i>from photos</a>
                                <a class="dropdown-item" href="#"><i class="feather icon-film mr-2"></i> upload video</a>
                                <a class="dropdown-item" href="#"><i class="feather icon-trash-2 mr-2"></i>remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body py-0">
                <div class="user-about-block m-0">
                    <div class="row">
                        <div class="col-md-4 text-center mt-n5">
                            <div class="change-profile text-center">
                                <div class="dropdown w-auto d-inline-block">
                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="profile-dp">
                                            <div class="position-relative d-inline-block">
                                                <img class="img-radius img-fluid wid-100" src="{{asset('default.jpg')}}" alt="User image">
                                            </div>
                                            <div class="overlay">
                                                <span>change</span>
                                            </div>
                                        </div>
                                        <div class="certificated-badge">
                                            <i class="fas fa-certificate text-c-blue bg-icon"></i>
                                            <i class="fas fa-check front-icon text-white"></i>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"><i class="feather icon-upload-cloud mr-2"></i>upload new</a>
                                        <a class="dropdown-item" href="#"><i class="feather icon-image mr-2"></i>from photos</a>
                                        <a class="dropdown-item" href="#"><i class="feather icon-shield mr-2"></i>Protact</a>
                                        <a class="dropdown-item" href="#"><i class="feather icon-trash-2 mr-2"></i>remove</a>
                                    </div>
                                </div>
                            </div>
                            <h5 class="mb-1">{{Auth::user()->name}}</h5>
{{--                            <p class="mb-2 text-muted">UI/UX Designer</p>--}}
                        </div>
                        <div class="col-md-8 mt-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="#!" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-globe mr-2 f-18"></i>www.phoenixcoded.net</a>
                                    <div class="clearfix"></div>
                                    <a href="mailto:demo@domain.com" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-mail mr-2 f-18"></i>{{Auth::user()->email}}</a>
                                    <div class="clearfix"></div>
                                    <a href="#!" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-phone mr-2 f-18"></i>{{Auth::user()->no_hp}}</a>
                                </div>
                                <div class="col-md-6">
                                    <div class="media">
                                        <i class="feather icon-map-pin mr-2 mt-1 f-18"></i>
                                        <div class="media-body">
                                            <p class="mb-0 text-muted">4289 Calvin Street</p>
                                            <p class="mb-0 text-muted">Baltimore, near MD Tower Maryland,</p>
                                            <p class="mb-0 text-muted">Maryland (21201)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 order-md-2">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Personal details</h5>
{{--                            <button type="button" class="btn btn-primary btn-sm rounded m-0 float-right has-ripple collapsed" data-toggle="collapse" data-target=".pro-det-edit" aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">--}}
{{--                                <i class="feather icon-edit"></i>--}}
{{--                                <span class="ripple ripple-animate" style="height: 32px; width: 32px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: 10px; left: -5.98438px;"></span>--}}
{{--                            </button>--}}
                        </div>
                        <div class="card-body border-top pro-det-edit collapse show" id="pro-det-edit-1" style="">
                            <form>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Full Name</label>
                                    <div class="col-sm-9">
                                        {{$data->user['name'] ?? null}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Number Virtual Account</label>
                                    <div class="col-sm-9">
                                        {{$data->code_virtual ?? null}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Saldo</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="mysaldo" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Birth Date</label>
                                    <div class="col-sm-9">
                                        {{$data->tanggal_lahir ?? null}}
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body border-top pro-det-edit collapse" id="pro-det-edit-2" style="">
                            <form>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Full Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Full Name" value="Lary Doe">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Gender</label>
                                    <div class="col-sm-9">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" checked="">
                                            <label class="custom-control-label" for="customRadioInline1">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline2">Female</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Birth Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" value="1994-12-16">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Martail Status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Select Marital Status</option>
                                            <option>Married</option>
                                            <option selected="">Unmarried</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Location</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control">4289 Calvin Street,  Baltimore, near MD Tower Maryland, Maryland (21201)</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @role('member')
        <div class="col-md-12 order-md-2">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">History Sewa Kos Kosan</h5>
                            {{--                            <button type="button" class="btn btn-primary btn-sm rounded m-0 float-right has-ripple collapsed" data-toggle="collapse" data-target=".pro-det-edit" aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">--}}
                            {{--                                <i class="feather icon-edit"></i>--}}
                            {{--                                <span class="ripple ripple-animate" style="height: 32px; width: 32px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: 10px; left: -5.98438px;"></span>--}}
                            {{--                            </button>--}}
                        </div>
                        <div class="card-body border-top pro-det-edit collapse show" id="pro-det-edit-1" style="">
                            <form>

                                @forelse($logs as $key => $item)
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Status Pembayaran</label>
                                        <div class="col-sm-9">
                                            {{$item->status ?? null}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Total Pembayaran</label>
                                        <div class="col-sm-9">
                                            Rp. {{$item->total_pembayaran ?? null}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Name Kosan</label>
                                        <div class="col-sm-9">
                                            {{$item->room_kosan['name'] ?? null}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Location</label>
                                        <div class="col-sm-9">
                                            {{$item->room_kosan['location'] ?? null}}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Sewa Perbulan</label>
                                        <div class="col-sm-9">
                                            Rp. {{$item->room_kosan['price'] ?? null}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Lama Sewa</label>
                                        <div class="col-sm-9">
                                            {{$item->kontrak_sewa['lama_sewa'] ?? null}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Mulai Sewa</label>
                                        <div class="col-sm-9">
                                            {{$item->kontrak_sewa['mulai_sewa'] ?? null}}
                                        </div>
                                    </div>
                                @empty

                                @endforelse
                            </form>
                        </div>
                     </div>
                </div>
            </div>
        </div>
        @endrole

        @role('admin')
        <div class="col-md-12 order-md-2">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">History Sewa Kos Kosan Member</h5>
                            {{--                            <button type="button" class="btn btn-primary btn-sm rounded m-0 float-right has-ripple collapsed" data-toggle="collapse" data-target=".pro-det-edit" aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">--}}
                            {{--                                <i class="feather icon-edit"></i>--}}
                            {{--                                <span class="ripple ripple-animate" style="height: 32px; width: 32px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: 10px; left: -5.98438px;"></span>--}}
                            {{--                            </button>--}}
                        </div>
                        <div class="card-body border-top pro-det-edit collapse show" id="pro-det-edit-1" style="">
                            <form>

                                @forelse($log_all as $key => $item)
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Name Penyewa</label>
                                        <div class="col-sm-9">
                                            {{$item->user['name'] ?? null}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Status Pembayaran</label>
                                        <div class="col-sm-9">
                                            {{$item->status ?? null}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Total Pembayaran</label>
                                        <div class="col-sm-9">
                                            Rp. {{rupiah($item->total_pembayaran ?? null) }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Name Kosan</label>
                                        <div class="col-sm-9">
                                            {{$item->room_kosan['name'] ?? null}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Location</label>
                                        <div class="col-sm-9">
                                            {{$item->room_kosan['location'] ?? null}}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Sewa Perbulan</label>
                                        <div class="col-sm-9">
                                            Rp. {{rupiah($item->room_kosan['price'] ?? null )}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Lama Sewa</label>
                                        <div class="col-sm-9">
                                            {{$item->kontrak_sewa['lama_sewa'] ?? null}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Mulai Sewa</label>
                                        <div class="col-sm-9">
                                            {{$item->kontrak_sewa['mulai_sewa'] ?? null}}
                                        </div>
                                    </div>
                                @empty

                                @endforelse
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endrole
    </div>
@stop

@section('script-page')

    <script>
        $('.mysaldo').val(formatRupiah('{{$data->saldo}}', ""))

        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split   	    = number_string.split(','),
                sisa     		= split[0].length % 3,
                rupiah     		= split[0].substr(0, sisa),
                ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
            return prefix === undefined ? rupiah : rupiah ? `Rp. ${rupiah}` : "";
        }
    </script>
@stop
