@extends('layouts.default')

@section('style-page')
    <!-- data tables css -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/lightbox.min.css')}}">
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
        <div class="card">
            <div class="card-header">
                <h5>{{$title}}</h5>
            </div>
            <div class="card-body">
                @role('member')
                <div class="dt-responsive table-responsive">
                    <a href="{{route('bukti-trasnfer.bukti-create')}}">
                        <button type="button" class="btn btn-success float-right"><i class="feather mr-2 feather icon-plus-square"></i>Upload Bukti Transfer</button>
                    </a>
                </div>
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
                <div class="dt-responsive table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered nowrap">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Nominal</th>
                            <th>Bukti Transfer</th>
                            <th>Status</th>
                            @role('admin')
                            <th>Action</th>
                            @endrole
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

    <script src="{{asset('assets/js/plugins/lightbox.min.js')}}"></script>

    <script type="text/javascript">
        var oTable;
        $(document).ready( () => {
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
                    url : '{{route('bukti-trasnfer.datatable')}}',
                    function(d) {

                    }
                },
                columns: [
                    {data : 'id' , name: 'id'},
                    {data : 'pengirim' , name: 'pengirim'},
                    {data : 'idr' , name: 'idr'},
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
                    {data : 'is_status' , name: 'is_status' },
                @role('admin')
                    {data : 'id' , name: 'id', render: (data, type, row) => {
                        if(row.status == 0) {
                            return '<a href="{{url('/bukti-trasnfer/apply/')}}/'+row.id+'" title="apply" ><i class="feather mr-2 feather icon-feather"></i>Check Transfer</a>';
                            // '<a href="#" onClick="deleteUser('+row.id+')" title="delete" ><i class="feather mr-2 feather icon-trash-2"></i></a>';
                        } else {
                            return '<span class="text-success"><i class="feather mr-2 feather icon-thumbs-up "></i>Done Check</span>';
                        }

                    }
                    },
                    @endrole
                ]
            });
        });

        const deleteUser = id => {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Yakin ingin menghapus data?',
                text: "Data yang sudah di hapus tidak bisa di kembalikan!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Delete!'
            }).then(() => {
                $.ajax({
                    url : "{{ url('user/delete') }}" + '/' + id,
                    type : "POST",
                    data : {
                        '_method' : 'DELETE',
                        '_token' : '{{ csrf_token() }}'
                    },
                    success : data => {
                        oTable.ajax.reload();
                        if(data.status == "ok"){
                            toastr["success"](data.messages);
                        }
                    },
                    error: function(data){
                        var data = data.responseJSON;
                        if(data.status == "fail"){
                            toastr["error"](data.messages);
                        }
                    }
                });
            });
        };
    </script>
@stop
