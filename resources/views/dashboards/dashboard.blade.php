@extends('dashboards.app')

@section('title', 'Dashboard')

@section('styles')
@endsection

@section('content')
<div class="section-header border-top">
    <h1>Dashboard</h1>
</div>

<div class="section-body">
    <h2 class="section-title">Selamat datang di Dashboard <span class="text-primary">{{ config('app.name') }}</span></h2>
</div>

<div class="row">

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-eye-dropper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Data <br> Penyakit</h4>
                </div>
                <div class="card-body">
                    {{ $total['diseases'] }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-eye-dropper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Data <br> Gejala</h4>
                </div>
                <div class="card-body">
                    {{ $total['symptoms'] }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('javascript')

@endsection
