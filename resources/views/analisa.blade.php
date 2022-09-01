@extends('layouts.app')

@section('title', 'Hasil Analisa')

@section('styles')
@endsection

@section('content')
<div class="container">

    <form name="form-konsultasi" method="post" action="{{ route('konsultasi.process') }}" autocomplete="off" class="needs-validation" novalidate>
        @csrf
        <div class="section-body">
            <h2 class="section-title">Hasil Analisa {{ config('app.name') }}</h2>

            <div class="hero bg-primary text-white mb-4">
                  <div class="hero-inner">
                    <h2>Hallo, {{ $input['nama'] ?? null }}!</h2>
                    <p class="lead">Berikut adalah hasil analisa Menggunakan Sistem Pakar Metode CBR (Case Based Reasoning)</p>
                  </div>
                </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Gejala Yang Dipilih</h4>
                </div>
                <div class="card-body">
                    <ol class="mb-0">
                        @foreach($symptoms as $symptom)
                        <li>{{ $symptom->nama_gejala }}</li>
                        @endforeach
                    </ol>
                </div>
            </div>

            <button class="btn btn-primary btn-lg mb-4" type="button" data-toggle="collapse" data-target="#collapsePerhitungan" aria-expanded="false" aria-controls="collapsePerhitungan">
                <i class="fa fa-fw fa-calculator"></i> Lihat Perhitungan
            </button>

            <div class="collapse" id="collapsePerhitungan">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Studi Kasus</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%">Kode</th>
                                        <th>Nama Penyakit</th>
                                        <th>Nama Gejala</th>
                                        <th width="10%" class="text-center">Bobot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cases as $case)
                                        <tr>
                                            <td rowspan="{{ count($case->disease->caseStudies)+1 }}">P{{ $case->disease->id }}</td>
                                            <td rowspan="{{ count($case->disease->caseStudies)+1 }}">
                                                <strong>{{ $case->disease->nama_penyakit }}</strong>
                                            </td>
                                        </tr>
                                        @foreach($case->disease->caseStudies as $cs)
                                        @php($isChoice = false)
                                        @php($isChoice = in_array($cs->symptoms_id, $input['symptoms']))
                                        <tr>
                                            <td class="{{ $isChoice ? 'text-success' : null }}">
                                                {{ $cs->symptom->nama_gejala }}
                                                {!! $isChoice ? '<i class="fa fa-fw fa-check"></i>' : null !!}
                                            </td>
                                            <td class="text-center">{{ $cs->symptom->bobot }}</td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-header">
                        <h4 class="mb-0">Table Data</h4>
                    </div>
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-md mb-0" style="width:auto">
                                <thead>
                                    <tr class="bg-primary">
                                        <th class="text-white align-middle" width="20px" rowspan="2">Kode</th>
                                        <th class="text-white align-middle" rowspan="2" width="500px">Gejala</th>
                                        <th class="text-white align-middle" width="10%" class="text-center" rowspan="2" width="100px">Bobot</th>
                                        <th class="text-white text-center" colspan="{{ count($rumus['table_data'][0]['diseases']) }}">Kode Penyakit</th>
                                    </tr>
                                    <tr>
                                        @foreach($rumus['table_data'][0]['diseases'] as $disease)
                                        <th width="250px" class="text-center align-middle">P{{ $disease['id'] }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rumus['table_data'] as $item)
                                    <tr>
                                        <td class="font-weight-bold bg-primary text-white">G{{ $item['id'] }}</td>
                                        <td class="font-weight-bold bg-primary text-white">{{ $item['nama_gejala'] }}</td>
                                        <td class="text-center font-weight-bold bg-primary text-white">{{ $item['bobot'] }}</td>
                                        @foreach($item['diseases'] as $disease)
                                            <td class="text-center">{{ $disease['similiar'] }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-header">
                        <h4 class="mb-0">Perhitungan Rumus</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($rumus['perhitungan'] as $perhitungan)
                            <li class="list-group-item">
                                <p class="mb-0">
                                <strong>P{{ $perhitungan['id'] }} = </strong>
                                @foreach($perhitungan['text_similiar'] as $text){{ $text }}{{ ! $loop->last ? '+': null }}@endforeach
                                </p>

                                <table>
                                    <tr>
                                        <th rowspan="2" class="align-middle"><strong>P{{ $perhitungan['id'] }} = </strong></th>
                                        <td class="border-bottom text-center">@foreach($perhitungan['text_total_similiar'] as $text){{ $text }} {{ ! $loop->last ? '+': null }}@endforeach</td>
                                        <th rowspan="2" class="align-middle"> <div class="mx-2">=</div> </th>
                                        <td class="border-bottom text-center">{{ $perhitungan['total_similiar'] }}</td>
                                        <th rowspan="2" class="align-middle"> <div class="mx-2">=</div> </th>
                                        <th rowspan="2" class="align-middle"> {{ $perhitungan['total_perhitungan'] }} </th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">@foreach($rumus['bobot'] as $text){{ $text }} {{ ! $loop->last ? '+': null }}@endforeach</td>
                                        <td class="text-center">{{ $perhitungan['total_bobot'] }}</td>
                                    </tr>
                                </table>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- <div class="card-body"> --}}
                        {{-- {!! xdebug_var_dump($results) !!} --}}
                        {{-- {!! xdebug_var_dump($rumus) !!} --}}
                    {{-- </div> --}}
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Hasil Analisa</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered table-md">
                            <thead>
                                <tr>
                                    <th width="8%">Ranking</th>
                                    <th width="15%">Kode Penyakit</th>
                                    <th>Nama Penyakit</th>
                                    <th width="25%">Nilai Similarity</th>
                                    <th width="10%">Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $result)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}.</td>
                                    <td>P{{ $result['id'] }}</td>
                                    <td>{{ $result['nama_penyakit'] }}</td>
                                    <td>{{ $result['total_perhitungan'] }}</td>
                                    <td>
                                        <a href="{{ route('diseases', $result['id']) }}" class="btn btn-primary btn-md" target="_blank">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <p class="lead">
                            Penyakit Terpilih = <strong>{{ $results[0]['nama_penyakit'] }}</strong> dengan Similaritas tertinggi  = <strong>{{ $results[0]['total_perhitungan'] }}</strong>
                        </p>

                    </div>
                </div>
            </div>

        </div>
    </form>

</div>
@endsection


@section('javascript')

@endsection
