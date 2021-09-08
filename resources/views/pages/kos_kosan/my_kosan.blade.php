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
                <h5>{{$title}} {{$title_header}}</h5>
            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                </div>
                <div class="dt-responsive table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered nowrap">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Harga Sewa</th>
                            <th>Tanggal Sewa</th>
                            <th>Periode Sewa</th>
                            <th>Location</th>
                            <th>Bukti TF</th>
                            <th>Status</th>
                            @if(!Auth::user()->hasRole('member'))
                            <th>Action</th>
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

    <div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modal Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="applyForm" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row">
                            <label for=""> Select Status</label>
                            <select name="status" class="form-control select2">
                                <option value="">---</option>
                                <option value="2">Success</option>
                                <option value="3">Reject</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="clickBtn" class="btn  btn-primary">Save changes</button>
                </div>
                </form>
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
                    url : '{{route('my-kosan.datatable')}}',
                    function(d) {

                    }
                },
                columns: [
                    {data : 'kosan.name' , name: 'kosan.name'},
                    {data : 'kosan.price' , name: 'kosan.price', render: function (data, type, row) {
                            return `${formatRupiah(row.kosan.price, "")} /bulan`;
                        }
                    },
                    {data : 'mulai_sewa' , name: 'mulai_sewa'},
                    {data : 'lama_sewa' , name: 'lama_sewa', render: function (data, type, row) {
                        return `${row.lama_sewa} bulan`
                        }},
                    {data : 'kosan.location' , name: 'kosan.location'},
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
                    {data : 'id' , name: 'id' , searchable: false, orderable: false, render: function (data, type, row) {
                        if(row.status == 1){
                            return 'Pending'
                        } else if(row.status == 0){
                            return 'Non Active'
                        } else if(row.status == 2 ){
                            return 'Active'
                        }
                        }
                    },
                        @if(!Auth::user()->hasRole('member'))
                    {data:'id',render: function (data, type, row) {
                        if(row.status != 1) {
                            return '<p class="text-success"><i class="feather mr-2 feather icon-thumbs-up"></i> Done Check</p>'
                        } else {
                            return '<a onclick="updateSatus('+row.id+')" class="text-warning" ><i class="feather mr-2 feather icon-feather"></i>Check Now</a>';
                        }
                    }
                    }
                        @endif
                ]
            });
        });

        function updateSatus(id) {
            $('#exampleModalCenter').modal('show')
            var idKosan = id;
            var url = '{{url('/my-kosan')}}' + '/' + idKosan
            $('#id').val(idKosan)
            $(document).ready( () => {
                $('#clickBtn').on('click', (e) => {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: url,
                        // data: $(this).find('input,select,textarea').serialize(),
                        data: new FormData($('#applyForm')[0]),
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: (data) => {
                            if(data.status === "ok"){
                                $('#exampleModalCenter').modal('hide')
                                toastr["success"](data.messages);
                                oTable.ajax.reload(false)
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
        }

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
