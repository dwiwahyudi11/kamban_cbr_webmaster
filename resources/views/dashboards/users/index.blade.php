@extends('dashboards.app')

@section('title', 'Administrator')

@section('styles')
<link rel="stylesheet" href="{{ asset('modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('modules/datatables/datatables/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="section-header">
    <h1>Administrator</h1>
    
    <div class="section-header-button ml-auto">
        <a class="btn btn-primary" href="{{ route('dashboard.users.create') }}">
            New Administrator
        </a>
    </div>
</div>

<div class="section-body">
    <div class="collapse" id="advanced-search">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-0">
                            <label for="name">Search Name</label>
                            <input type="text" class="form-control" id="name" autocomplete="off">
                        </div>
                        <div class="form-group col-md-6 mb-0">
                            <label for="email">Search Email</label>
                            <input type="text" class="form-control" id="email" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">       
                    <button type="button" id="reset-form" class="btn btn-icon btn-sm btn-default"><i class="fas fa-fw fa-redo"></i> Reset</button>
                    <button type="button" id="search-form" class="btn btn-icon btn-sm btn-primary"><i class="fas fa-fw fa-search"></i> Search</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped" id="table-data">
                            <thead>
                                <tr>  
                                    <th width="5%">#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    {{-- <th width="15%">Level</th> --}}
                                    <th width="15%">Last Login</th>
                                    <th width="20%">&nbsp;</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src="{{ asset('modules/datatables/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('modules/datatables/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('modules/sweetalert/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
    var tableData;
    $(function() {
        @if ($message = Session::get('success'))
            toastr.success('{{ $message }}', 'Success');
        @endif

        tableData = $('#table-data').DataTable({
            dom: "<'row align-items-center'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 search-button-collapse'>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            processing: true,
            serverSide: true,
            pageLength: 25,
            ajax: {
                url: '{{ route('dashboard.users.index') }}',
                data: function(f) {
                    f.name  = $('#name').val();
                    f.email = $('#email').val();
                }
            },
            order: [],
            columns: [
                { data: 'index_row', orderable: false, searchable: false},
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                // { data: 'roles', orderable: false, searchable: false},
                { data: 'last_login_at', searchable: false,
                    render: function(data){
                        const localDate = moment(data);
                        return (moment(data).isValid()) ? moment(localDate).fromNow() : '-';
                    }
                },
                { data: 'action', orderable: false, searchable: false}
            ],
        });
        $('.search-button-collapse').addClass('text-right').html('<a data-toggle="collapse" href="#advanced-search" class="btn btn-icon"><i class="fas fa-fw fa-search"></i> Cari</a>')
        $('#search-form').on('click', function(e) {
            e.preventDefault();
            tableData.draw();
        });
        $('#reset-form').on('click', function(e){
            e.preventDefault();
            $('#name').val('');
            $('#email').val('');
            tableData.draw();
        })
    });

    function delete_data(id)
    {
        var formUrl = $('#button-delete-'+ id).data('route');
        swal({
            title: 'Are you sure?',
            text: 'Do you want to delete this record?',
            buttons: {
                cancel: true,
                confirm: {
                    text: "Hapus!",
                    closeModal: false,
                }
            },
            dangerMode: true,
            closeOnClickOutside: false
        })
        .then((willDelete) => {
            if (willDelete) {
                 $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    type: 'POST',
                    url : formUrl,
                    dataType: 'JSON',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        '_method': 'DELETE',
                        'id': id, 
                    },
                    success: function(res)
                    {
                        swal.stopLoading();
                        swal.close();
                        if(res.status == true)
                        {
                            toastr.success(res.message, 'Success');
                            tableData.ajax.reload(null,false);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal.stopLoading();
                        swal.close();
                        toastr.error('Error deleted data', 'Error');
                    }
                });
            }
        });
    }
    </script>
@endsection