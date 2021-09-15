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
                    @role('member')
                    <table>
                        <p>Silakan Transfer ke nomor rekening di bawah ini.</p>
                        <tr>
                            <th>Name Bank:
                            <td>BRI</td>
                            </th>
                        </tr>
                        <tr>
                            <th>Name:
                            <td>INA</td>
                            </th>
                        </tr>
                        <tr>
                            <th>No Rekening:
                            <td>8955156966</td>
                            </th>
                        </tr>
                    </table>
                    @endrole
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="payNowForm" method="post" action="{{route('kos-kosan.pay-now-store',$id)}}" enctype="multipart/form-data" >
                                {{ csrf_field() }} {{ method_field('POST') }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" class="form-control disabledTrue" value="{{$data->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Price</label>
                                            <input type="text" class="form-control idr disabledTrue">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Fasilitas</label>
                                            <input type="text" class="form-control disabledTrue" value="{{$data->fasilitas['fasilitas_name']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Lokasi</label>
                                            <input type="text" class="form-control disabledTrue"  value="{{$data->location}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Mulai Sewa</label>
                                            <input type="date" class="form-control" name="mulai_sewa">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Lama Sewa</label>
                                            <select name="lama_sewa" class="js-example-placeholder-sewa col-sm-12 lamaSewa">
                                                <option value="">---</option>
                                                @forelse($bulans as $key => $item)
                                                    <option value="{{$key}}">{{$item}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Total Pembayaran</label>
                                            <input type="text" disabled class="form-control" id="totalPembayaran">
                                        </div>
                                    </div>
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="form-group fill">--}}
{{--                                            <label for="exampleInputEmail1">Upload Bukti Transfer</label>--}}
{{--                                            <input type="file" class="form-control " name="bukti_transfer">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
{{--                                        <input type="hidden" name="code_pin" id="valuePin">--}}
                                        <input type="hidden" name="id" value="{{$id}}">
{{--                                        <input type="hidden" name="payment" value="{{$data->price}}">--}}
{{--                                        <button type="button" id="disabled" class="btn  btn-primary" data-toggle="modal" data-target="#exampleModalLive">--}}
{{--                                            <i class="feather mr-2 feather icon-save"></i>Submit</button>--}}
                                        <button type="submit" id="disabled" class="btn  btn-primary payNowClick">
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

    <div id="exampleModalLive" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Your PIN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="payNowForm" method="post" action="" enctype="multipart/form-data" >
                    {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="form-group fill">
                            <label for="">Pin Code</label>
                            <input type="password" class="form-control" maxlength="6" name="code_pin" id="code_pin">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn  btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script-page')
    <!-- select2 Js -->
    <script src="{{asset('assets/js/plugins/select2.full.min.js')}}"></script>
    <!-- form-select-custom Js -->
    <script src="{{asset('assets/js/pages/form-select-custom.js')}}"></script>

    <script type="text/javascript">
        $('.disabledTrue').prop('disabled',true);
        $('.idr').val(`${formatRupiah('{{$data->price}}', "")} /bulan`);
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

        function totalPembayaran(angka, prefix){
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
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
            $('.lamaSewa').on('change', function() {
                var bulan = $(this).val();
                var total = {{(int)$data->price}} * bulan
                $('#totalPembayaran').val(`Rp. ${totalPembayaran(total)}`)
            })

            $('.payNowClick').on('click', (e) => {
                // $('#valuePin').val($('#code_pin').val())
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
                    data: new FormData($('#payNowForm')[0]),
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
                            $('#exampleModalLive').modal('hide')
                        }
                    }
                });
            });
        })
    </script>
@stop
