@extends('layouts.default')

@section('style-page')
    <!-- select2 css -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/select2.min.css')}}">
@stop

@section('content')
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">{{$title}} {{$title_header}}</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="feather icon-book"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">{{$title}} {{$title_header}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$title}} {{$title_header}}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="koskosanForm" method="post" action="{{empty($id) ? route('kos-kosan.store') : route('kos-kosan.update',$id)}}" enctype="multipart/form-data" >
                                {{ csrf_field() }} {{ method_field('POST') }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" class="form-control" name="name"  value="{{$data->name ?? null}}" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Price</label>
                                            <input type="text" class="form-control idr" name="price" value="{{$data->price ?? null}}" placeholder="Enter Price">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Fasilitas</label>
                                            <input type="text" class="form-control" name="fasilitas_name" value="{{$data->fasilitas['fasilitas_name'] ?? null}}"  placeholder="AC, TV, WIFI">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Lokasi</label>
                                            <input type="text" class="form-control" name="location" value="{{$data->location ?? null}}"  placeholder="Pontianak">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Upload File</label>
                                            <input type="file"  class="form-control" name="file_kosan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Type</label>
                                            <select name="type" class="js-example-placeholder-type col-sm-12">
                                                @if(!empty($data->is_type))
                                                    <option value="">---</option>
                                                    <option value="1" {{ $data->is_type['id'] == 1 ? "selected" : null}}>Campur</option>
                                                    <option value="2" {{ $data->is_type['id'] == 2 ? "selected" : null}}>Laki-Laki</option>
                                                    <option value="3" {{ $data->is_type['id'] == 3 ? "selected" : null}}>Perempuan</option>
                                                @else
                                                    <option value="">---</option>
                                                    <option value="1" >Campur</option>
                                                    <option value="2" >Laki-Laki</option>
                                                    <option value="3" >Perempuan</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group fill">
                                            <label for="inputAddress">Description</label>
                                            <input type="text" class="form-control" name="description" value="{{$data->description ?? null}}" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group fill">
                                            <label for="inputAddress">Map Link Embed</label>
                                            <input type="text" class="form-control" name="map" value="{{$data->map ?? null}}" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" id="disabled" class="btn  btn-primary">
                                            <i class="feather mr-2 feather icon-save"></i>Submit</button>
                                        <a href="{{route('home')}}">
                                            <button type="button" class="btn  btn-danger">
                                                <i class="feather mr-2 feather icon-corner-up-left"></i>Back</button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Input group -->
        </div>

    </div>
@stop

@section('script-page')
    <!-- select2 Js -->
    <script src="{{asset('assets/js/plugins/select2.full.min.js')}}"></script>
    <!-- form-select-custom Js -->
    <script src="{{asset('assets/js/pages/form-select-custom.js')}}"></script>

    <script type="text/javascript">
        $(document).on('keyup', ".idr",  function () {
            this.value = formatRupiah(this.value, "");
        });

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


        $(document).ready( () => {
            $('#koskosanForm').on('submit', (e) => {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: $(this).attr("action"),
                    // data: $(this).find('input,select,textarea').serialize(),
                    data: new FormData($('#koskosanForm')[0]),
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: (data) => {
                        if(data.status === "ok"){
                            toastr["success"](data.messages);
                            $("#disabled").prop('disabled', true);
                            window.location.href = data.route
                        }
                    },
                    error: (data) => {
                        var data = data.responseJSON;
                        if(data.status == "fail"){
                            toastr["error"](data.messages);
                        }
                    }
                });
            });
        })
    </script>
@stop
