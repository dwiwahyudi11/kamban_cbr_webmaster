@extends('layouts.app')

@section('title', 'Penyakit '. $disease->nama_penyakit)

@section('styles')
@endsection

@section('content')
<div class="container">

    <div class="section-body">
        <h2 class="section-title">{{ $disease->nama_penyakit }}</h2>

        <div class="card">
            <div class="card-header">
                <h4>Deskripsi</h4>
            </div>
            <div class="card-body">
                @if($disease->gambar)
                <img src="{{ asset('uploads/diseases/'. $disease->gambar) }}" class="rounded mx-auto d-block img-fluid" alt="{{ $disease->gambar }}">
                @endif

                <div class="mt-4">
                    {!! $disease->deskripsi !!}
                </div>
            </div>
            @if(count($disease->caseStudies) > 0)
                <div class="card-header">
                    <h4>Gejala</h4>
                </div>
                <div class="card-body">
                    <ol>
                        @foreach($disease->caseStudies as $case)
                        <li>
                            <b>{{ $case->symptom->nama_gejala }}</b>
                            @if($case->symptom->deskripsi)
                            {!! $case->symptom->deskripsi !!}
                            @endif
                        </li>
                        @endforeach
                    </ol>
                </div>
                @endif
            </div>
        </div>

        @if($disease->solusi)
        <div class="card">
            <div class="card-header">
                <h4>Solusi</h4>
            </div>
            <div class="card-body">
                {!! $disease->solusi !!}
            </div>
        </div>
        @endif

    </div>
    
</div>
@endsection

@section('javascript')

@endsection
