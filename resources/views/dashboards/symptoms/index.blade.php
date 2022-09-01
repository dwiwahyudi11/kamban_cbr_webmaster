@extends('dashboards.app')

@section('title', 'Data Gejala')

@section('styles')
<link rel="stylesheet" href="{{ asset('modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('modules/datatables/datatables/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="section-header">
    <h1>Data Gejala</h1>
    
    <div class="section-header-button ml-auto">
        <a class="btn btn-primary" href="{{ route('dashboard.symptoms.create') }}">
            Gejala Baru
        </a>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-data">
                            <thead>
                                <tr>  
                                    <th width="5%">#</th>
                                    <th>Gejala</th>
                                    <th width="20%">Bobot</th>
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
            processing: true,
            serverSide: true,
            pageLength: 25,
            searchDelay: 600,
            ajax: {
                url: '{{ route('dashboard.symptoms.index') }}'
            },
            order: [[1, 'asc']],
            columns: [
                { data: 'index_row', orderable: false, searchable: false},
                { data: 'nama_gejala', name: 'nama_gejala' },
                { data: 'bobot', name: 'bobot', className: 'text-center' },
                { data: 'action', orderable: false, searchable: false}
            ],
        });
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