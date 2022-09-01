@extends('dashboards.app')

@section('title', ($data ? 'Edit' : 'Tambah') .' Data Gejala')

@section('styles')
<link rel="stylesheet" href="{{ asset('modules/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('modules/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('dashboard.symptoms.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>{{ ($data ? 'Edit' : 'Tambah') }} Data Gejala</h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            
        @if($data)
            {!! Form::model($data, ['method' => 'PATCH', 'route' => ['dashboard.symptoms.update', $data->id], 'autocomplete'=>'off', 'class'=> 'needs-validation', 'novalidate'=> '']) !!}
        @else
            {!! Form::open(['method' => 'POST', 'route' => 'dashboard.symptoms.store', 'autocomplete'=>'off', 'class'=> 'needs-validation', 'novalidate'=> '']) !!}
        @endif
            <div class="card">
                <div class="card-body">

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul class="mb-0">
                           @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                           @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="form-group row">
                        <label for="nama_gejala" class="col-sm-3 col-form-label">Nama Gejala</label>
                        <div class="col-sm-9">
                            {!! Form::text('nama_gejala', null, ['id' => 'nama_gejala', 'placeholder' => 'Nama Gejala', 'class' => 'form-control', 'required', 'autofocus']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-3 col-form-label">Deksripsi Gejala</label>
                        <div class="col-sm-9">
                            {!! Form::textarea('deskripsi', null, ['id' => 'deskripsi', 'placeholder' => 'Deskripsi Gejala', 'class' => 'form-control summernote']) !!}
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <label for="bobot" class="col-sm-3 col-form-label">Bobot</label>
                        <div class="col-sm-9">
                            {!! Form::text('bobot', null, ['id' => 'bobot', 'placeholder' => 'Bobot', 'class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-lg btn-primary">Save</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src="{{ asset('modules/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('modules/summernote/summernote-bs4.js') }}"></script>
    <script type="text/javascript">
    $(function(){
        @if ($message = Session::get('success'))
            toastr.success('{{ $message }}', 'Success');
        @endif

        $('.summernote').summernote({
            dialogsInBody: true,
            mineight: 200,
        });
    });
    </script>
@endsection