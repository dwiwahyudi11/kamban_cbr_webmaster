@extends('layouts.app')

@section('title', 'Konsultasi')

@section('styles')
@endsection

@section('content')
<div class="container">

    <form name="form-konsultasi" method="post" action="{{ route('konsultasi.process') }}" autocomplete="off" class="needs-validation" novalidate>
        @csrf
        <div class="section-body">
            <h2 class="section-title">Konsultasi {{ config('app.name') }}</h2>

            <div class="card">
                <div class="card-body">

                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            
                            <table class="table table-bordered table-hover mb-0">
                                <tr class="table-info">
                                    <th class="text-center text-uppercase text-dark">
                                        <label for="nama" class="d-block mb-0">Nama</label>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}" required>
                                    </td>
                                </tr>
                                <tr class="table-info">
                                    <th class="text-center text-uppercase text-dark">
                                        <label for="gejala" class="d-block mb-0">Gejala</label>
                                    </th>
                                </tr>
                                @foreach($symptoms as $symptom)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="symptoms[]" id="symptom-{{ $symptom->id }}" value="{{ $symptom->id }}">
                                            <label class="form-check-label" for="symptom-{{ $symptom->id }}">
                                                {{ $symptom->nama_gejala }}
                                                @if($symptom->deskripsi)
                                                <div class="text-muted d-block">
                                                    {{ $symptom->deskripsi }}
                                                </div>
                                                @endif
                                            </label>
                                        </div>
                                    </td>
                                </tr>       
                                @endforeach
                                <tr>
                                    <td>
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            Proses
                                        </button>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>

                    
                    
                </div>
            </div>

        </div>
    </form>

</div>
@endsection


@section('javascript')

@endsection
