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
                            <h5 class="m-b-10">{{$title}}</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="{{$icon}}"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">{{$title}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$title}}</h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <form id="virtualForm" method="post" action="{{empty($id) ? route('bukti-trasnfer.bukti-store') : route('bukti-trasnfer.apply-store',$id)}}" enctype="multipart/form-data" >
                                {{ csrf_field() }} {{ method_field('POST') }}
                                @if(empty($data->id))
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Nominal</label>
                                            <input type="text" class="form-control idr" name="nominal">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Upload Bukti Transfer</label>
                                            <input type="file" class="form-control " name="bukti_transfer">
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if(!empty($data->id))
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group fill">
                                                <label for="exampleInputEmail1">Name Member</label>
                                                <input type="text" class="form-control" disabled  value="{{$data->user['name'] ?? null }}" placeholder="Soap Cat">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group fill">
                                                <label for="exampleInputEmail1">Virtual Account ID</label>
                                                <input type="text" class="form-control" disabled  value="{{$data->vitual['code_virtual'] ?? null }}" placeholder="Soap Cat">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group fill">
                                                <label for="exampleInputEmail1">Nominal</label>
                                                <input type="text" class="form-control" disabled  value="{{'Rp. '.rupiah($data->nominal) ?? null }}" placeholder="Soap Cat">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group fill">
                                                <label for="exampleInputEmail1">Bukti Transfer</label>
                                                <div class="thumbnail mb-4">
                                                    <div class="thumb">
                                                        <a href="#" data-lightbox="1" data-title="My caption 1">
                                                            <img src="{{$image ?? null}}" alt="" class="img-fluid img-thumbnail" width="100">
                                                        </a>                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Status</label>
                                            <select name="status" class="js-example-placeholder-type col-sm-12">
                                                <option value="">---</option>
                                                <option value="1">Success</option>
                                                <option value="2">Reject</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Member Virtual ID</label>
                                            <select name="virtual_id" class="js-example-placeholder-member col-sm-12">
                                                <option value="">---</option>
                                                @forelse($members as $key => $item)
                                                    <option value="{{$item->code_virtual}}">{{$item->user['name']}} - {{$item->code_virtual}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Saldo</label>
                                            <input type="text" class="form-control idr" name="saldo">
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" id="disabled" class="btn  btn-primary submitBtn">
                                            <i class="feather mr-2 feather icon-save"></i>Submit</button>
                                        <a href="{{route('home')}}">
                                            <button type="button" class="btn  btn-danger backBtn">
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
            $('#virtualForm').on('submit', (e) => {
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
                    data: new FormData($('#virtualForm')[0]),
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $('.submitBtn').html('<div class="text-white mr-2 align-self-center loader-sm ">Loading upload...</div>');
                        $('.submitBtn').prop('disabled', true);
                        $('.backBtn').addClass('d-none');
                    },
                    success: (data) => {
                        if(data.status === "ok"){
                            $('.submitBtn').html('Submit');
                            $('.submitBtn').prop('disabled', false);
                            $('.backBtn').removeClass('d-none');
                            toastr["success"](data.messages);
                            window.location.href = data.route
                        }
                    },
                    error: (data) => {
                        var data = data.responseJSON;
                        if(data.status == "fail"){
                            $('.submitBtn').html('Submit');
                            $('.submitBtn').prop('disabled', false);
                            $('.backBtn').removeClass('d-none');
                            toastr["error"](data.messages);
                        }
                    }
                });
            });
        })
    </script>
@stop
