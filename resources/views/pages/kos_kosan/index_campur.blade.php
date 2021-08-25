@extends('layouts.default')

@section('style-page')
    <!-- data tables css -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
    <!-- select2 css -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/lightbox.min.css')}}">
@stop

@section('content')
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">{{$title_header}}</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="feather icon-book"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">{{$title_header}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>{{$title_header}} - {{$title}}</h5>
            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    @role('admin')
                    <a href="{{route('kos-kosan.create')}}">
                        <button type="button" class="btn btn-outline-success float-right"><i class="feather mr-2 feather icon-plus-square"></i>Create</button>
                    </a>
                    @endrole
                </div>
                <div class="dt-responsive table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered nowrap">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Fasilitas</th>
                            <th>Harga Sewa</th>
                            <th>Location</th>
                            <th>Image</th>
                            @if(Auth::user()->status == 1)
                                <th>Salary</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script-page')
    <script src="{{asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/data-plugin-custom.js')}}"></script>

    <!-- select2 Js -->
    <script src="{{asset('assets/js/plugins/select2.full.min.js')}}"></script>
    <!-- form-select-custom Js -->
    <script src="{{asset('assets/js/pages/form-select-custom.js')}}"></script>

    <script src="{{asset('assets/js/plugins/lightbox.min.js')}}"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    </script>

    <script type="text/javascript">
        var oTable ;
        $(document).ready(() => {
            $.fn.dataTable.ext.errMode = 'none';

            oTable = $('#dataTable').DataTable({
                paging: true,
                lengthChange: false,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,
                order: [[ 2, 'desc' ]],
                ajax : {
                    url : '{{route('kos-kosan.datatable-campur')}}',
                    function(d) {

                    }
                },
                columns: [
                    {data : 'name' , name: 'name'},
                    {data : 'is_type.name' , name: 'is_type.name'},
                    {data : 'fasilitas.fasilitas_name' , name: 'fasilitas.fasilitas_name'},
                    {data : 'price' , name: 'price', render: function (data, type, row) {
                            return `${formatRupiah(row.price, "")} /bulan`;
                        }
                    },
                    {data : 'location' , name: 'location'},
                    {data : 'id' , name: 'id' , searchable: false, orderable: false, render: function (data, type, row) {
                            return ' <div class="thumbnail mb-4">\n' +
                                '                    <div class="thumb">\n' +
                                '                        <a href="'+row.image+'" data-lightbox="1" data-title="My caption 1">\n' +
                                '                            <img src="'+row.image+'" alt="" class="img-fluid img-thumbnail" width="50">\n' +
                                '                        </a>\n' +
                                '                    </div>\n' +
                                '                </div>'
                        }
                    },
                        @if(Auth::user()->status == 1)
                    {data: 'id', name: 'id' , searchable: false , orderable: false ,render : function(data, type , row) {
                            return '<a href="{{url('kos-kosan/pay-now')}}/'+row.id+'" title="pay" > <button ><i class="fas mr-2 fa-money-bill-wave text-info"></i> Pay Now</button> </a>'
                        }
                    }
                    @endif
                ]
            });
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
    </script>
@stop
