@extends('dashboards.app')

@section('title', ($data ? 'Edit' : 'Tambah') .' Data Penyakit')

@section('styles')
<link rel="stylesheet" href="{{ asset('modules/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('modules/summernote/summernote-bs4.css') }}">
<style>
    span.select2.select2-container.select2-container--default {
        margin-top: 1em;
    }
</style>
@endsection

@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('dashboard.diseases.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>{{ ($data ? 'Edit' : 'Tambah') }} Data Penyakit</h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            
        @if($data)
            {!! Form::model($data, ['method' => 'PATCH', 'route' => ['dashboard.diseases.update', $data->id], 'autocomplete'=>'off', 'enctype' => 'multipart/form-data', 'class'=> 'needs-validation', 'novalidate'=> '']) !!}
        @else
            {!! Form::open(['method' => 'POST', 'route' => 'dashboard.diseases.store', 'autocomplete'=>'off', 'enctype' => 'multipart/form-data', 'class'=> 'needs-validation', 'novalidate'=> '']) !!}
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
                        <label for="nama_penyakit" class="col-sm-3 col-form-label">Nama Penyakit</label>
                        <div class="col-sm-9">
                            {!! Form::text('nama_penyakit', null, ['id' => 'nama_penyakit', 'placeholder' => 'Nama Penyakit', 'class' => 'form-control', 'required', 'autofocus']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-3 col-form-label">Deksripsi Penyakit</label>
                        <div class="col-sm-9">
                            {!! Form::textarea('deskripsi', null, ['id' => 'deskripsi', 'placeholder' => 'Deskripsi Penyakit', 'class' => 'form-control summernote']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="solusi" class="col-sm-3 col-form-label">Solusi Penyakit</label>
                        <div class="col-sm-9">
                            {!! Form::textarea('solusi', null, ['id' => 'solusi', 'placeholder' => 'Solusi Penyakit', 'class' => 'form-control summernote']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gambar" class="col-sm-3 col-form-label">Gambar Penyakit</label>
                        <div class="col-sm-9">
                            <input type="file" name="gambar" class="form-control" id="gambar">
                            <p class="m-0 small">*Ukuran file maksimal 1MB</p>
                            @if($data && $data->gambar)
                            <div class="p-0 m-0">
                                <img id="preview-image" src="{{ asset('uploads/diseases/'.$data->gambar) }}" alt="{{ $data->gambar }}" class="img-thumbnail img-fluid fluid">
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="case_studies" class="col-sm-3 col-form-label">Studi Kasus</label>
                        <div class="col-sm-9">
                            @if(! $data)
                                {!! Form::select('case_studies[]', $optionsSymptoms, null, ['id' => 'case_studies', 'class' => 'form-control custom-select select2', 'placeholder' => 'Pilih Gejala', 'data-placeholder' => 'Pilih Gejala', 'required']) !!}
                            @elseif($data && count($data->caseStudies) > 0)
                                @foreach($data->caseStudies as $index => $case)
                                    <div id="row-case-{{ $case->id }}" class="row align-items-end">
                                        <div class="col">
                                            {!! Form::hidden('case_studies_id[]', $case->id) !!}
                                            {!! Form::select('case_studies[]', $optionsSymptoms, $case->symptoms_id, ['id' => 'case_studies_'. $case->id, 'class' => 'form-control custom-select select2', 'placeholder' => 'Pilih Gejala', 'data-placeholder' => 'Pilih Gejala', 'required']) !!}
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-outline-danger" type="button" onclick="removeOption('{{ $case->id }}')">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <div id="wrapper-symptoms"></div>

                            <div id="wrapper-deleted-case"></div>

                            <div class="text-right mt-3">
                                <button type="button" class="btn btn-outline-primary" onclick="addOption()">Tambah Gejala</button>
                            </div>
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
    var wrapper_symptoms = $('#wrapper-symptoms');
    var wrapperDeletedCase = $('#wrapper-deleted-case');
    var options_symptoms = @json($dataSymptoms, JSON_PRETTY_PRINT);

    $(function(){
        @if ($message = Session::get('success'))
            toastr.success('{{ $message }}', 'Success');
        @endif

        $('.summernote').summernote({
            dialogsInBody: true,
            mineight: 200,
        });
    });

    function addOption() {
        var newSelect = $('<select name="case_studies[]" class="form-control custom-select select2 mt-3" placeholder="Pilih Gejala" data-placeholder="Pilih Gejala"></select>');
        wrapper_symptoms.append(newSelect);

        $(newSelect).select2({ 
            placeholder: "Pilih Gejala",
            data: options_symptoms,
        });
    }

    function removeOption(id) {
        $('#row-case-'+ id).remove();
        var newDeleted = $('<input type="hidden" name="deleted_case[]" value="'+ id +'">');
        wrapperDeletedCase.append(newDeleted);
    }
    </script>
@endsection