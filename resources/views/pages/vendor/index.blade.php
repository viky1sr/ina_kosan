@extends('layouts.default')

@section('style-page')
    <!-- data tables css -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
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
                            <li class="breadcrumb-item"><a href="#"><i class="feather icon-user"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">{{$title}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>{{$title}}</h5>
            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered nowrap">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Number Phone</th>
                            <th>Email</th>
                            <th>Document</th>
                            <th>Action</th>
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
                order: [[ 0, 'desc' ]],
                ajax : {
                    url : '{{route('vendor.list-datatable')}}',
                    function(d) {

                    }
                },
                columns: [
                    {data : 'id' , name: 'id'},
                    {data : 'name' , name: 'name'},
                    {data : 'no_hp' , name: 'no_hp'},
                    {data : 'email' , name: 'email'},
                    {data: 'id', name: 'id' , searchable: false , orderable: false ,render : function(data, type , row) {
                        if(row.vendor != null) {
                            return '<a href="{{url('/vendor/download')}}/'+row.vendor.id+'" title="show" ><i class="feather mr-2 feather icon-download"></i>Download</a>'
                        } else {
                            return '';
                        }}
                    },
                    {data: 'id', name: 'id' , searchable: false , orderable: false ,render : function(data, type , row) {
                            return '<a href="{{url('/vendor/list')}}/'+row.id+'" title="show" ><i class="feather mr-2 feather icon-thumbs-up"></i>Check</a>'
                        }
                    },
                ]
            });
        });
    </script>
@stop