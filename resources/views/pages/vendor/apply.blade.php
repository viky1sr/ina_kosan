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
                            <li class="breadcrumb-item"><a href="{{route('visitor.index')}}"><i class="feather icon-user-plus"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('visitor.index')}}">{{$title}}</a></li>
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
                            <form id="applyForm" method="post" action="{{route('vendor.list-apply',$id)}}" enctype="multipart/form-data" >
                                {{ csrf_field() }} {{ method_field('POST') }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Name Vendor</label>
                                            <input type="text" disabled class="form-control" value="{{$data->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Name Kosan</label>
                                            <input type="text" disabled class="form-control" value="{{$data->vendor->name_kosan}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Number Phone Vendor</label>
                                            <input type="text" disabled class="form-control" value="{{$data->no_hp}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Number Phone Kosan</label>
                                            <input type="text" disabled class="form-control" value="{{$data->vendor->no_hp_kosan}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="text" disabled class="form-control" value="{{$data->email}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">File Pendukung</label>
                                            <a class="form-control" href="{{url('/vendor/download')}}/{{$data->vendor->id}}" title="show" ><i class="feather mr-2 feather icon-download"></i>Download</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Reason</label>
                                            <textarea class="form-control text-justify" disabled rows="4">
                                                {{$data->vendor->reason}}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Address</label>
                                            <textarea class="form-control text-justify" disabled rows="4">
                                                {{$data->vendor->address}}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group fill">
                                            <label for="exampleInputEmail1">Reason</label>
                                            <select name="status" class="form-control select2">
                                                <option value="">---</option>
                                                <option value="1">Success</option>
                                                <option value="3">Reject</option>
                                            </select>
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
        $(document).ready( () => {
            $('#applyForm').on('submit', (e) => {
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
                    data: new FormData($('#applyForm')[0]),
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
