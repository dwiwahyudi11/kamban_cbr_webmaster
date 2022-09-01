@extends('dashboards.app')

@section('title', 'Management Role')

@section('content')
<div class="section-header">
    <h1>Management Role</h1>

    <div class="section-header-button ml-auto">
        @can('roles-create')
        <a class="btn btn-primary" href="{{ route('dashboard.roles.create') }}">
            New Role
        </a>
        @endcan
        @role('superadmin')
        <a class="btn btn-primary" href="{{ route('dashboard.permissions.index') }}">
            Management Access Control
        </a>
        @endrole
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body p-0">
                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th width="50px">No.</th>
                                <th>Name</th>
                                <th width="30%">&nbsp;</th>
                            </tr>
                            @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>
                                    @if($role->fixed == 1)
                                        <div class="badge badge-primary">{{ ucfirst($role->name) }}</div>
                                    @else
                                        {{ ucfirst($role->name) }}
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-toolbar" role="toolbar">
                                        <div class="btn-group mr-2" role="group">
                                            <a class="btn btn-outline-primary" href="{{ route('dashboard.roles.show',$role->id) }}">Detail</a>
                                            @can('roles-edit')
                                                <a class="btn btn-primary" href="{{ route('dashboard.roles.edit', $role->id) }}">Edit</a>
                                            @endcan
                                        </div>
                                        @if($role->fixed == 0)
                                        @can('roles-delete')
                                        <div class="btn-group">
                                            {!! Form::open(['method' => 'DELETE','route' => ['dashboard.roles.destroy', $role->id], 'style' => 'display:inline', 'id' => 'delete-'. $role->id]) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'data-confirm'=> 'Warning!|Do you want to delete this record?', 'data-confirm-yes'=>'document.getElementById(\'delete-'. $role->id .'\').submit()']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                        @endcan
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">
                        {!! $roles->render() !!}
                    </nav>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('javascript')
<script type="text/javascript">
    @if ($message = Session::get('success'))
        toastr.success('{{ $message }}', 'Sukses');
    @elseif($message = Session::get('error'))
        toastr.error('{{ $message }}', 'Gagal');
    @endif
</script>
@endsection