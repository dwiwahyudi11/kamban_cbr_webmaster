@extends('layouts.app')

@section('title', 'Home')

@section('styles')
@endsection

@section('content')
{{-- <div class="section-header">
    <h1>Home</h1>
</div> --}}
<header class="masthead text-white text-center d-flex align-items-center" style="background-image: url('{{ asset('images/bg-1.jpg') }}'); background-position: center; background-size: cover;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto">
                <h1 class="mb-4">Website Sistem Pakar <br>Untuk Mendiagnosa Penyakit Pada Tanaman Semangka <br>Menggunakan Metode CBR (Case Based Reasoning)</h1>
            </div>
            <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                <a href="{{ route('konsultasi') }}" class="btn btn-lg btn-success" >Mulai Konsultasi</a>
            </div>
        </div>
    </div>
</header>

<div class="container mt-4">
    <h1 class="text-center text-uppercase text-success">Cara Kerja Sistem Web Ini</h1>
    <div class="row mt-4">
        <div class="col-md-3 text-center">
            <i class="fas fa-fw fa-tachometer-alt text-danger fa-4x"></i>
            <h2 class="mt-3">Login</h2>
            <p class="h5">Login sebagai untuk manajemen data di sistem.</p>
        </div>
        <div class="col-md-3 text-center">
            <i class="fas fa-fw fa-eye-dropper text-danger fa-4x"></i>
            <h2 class="mt-3">Input Data</h2>
            <p class="h5">Lengkapi manajemen data penyakit dan data gejala di sistem.</p>
        </div>
        <div class="col-md-3 text-center">
            <i class="fas fa-fw fa-thermometer-half text-danger fa-4x"></i>
            <h2 class="mt-3">Basis Kasus</h2>
            <p class="h5">Hubungkan penyakit dan gejala pada data kasus di sistem.</p>
        </div>
        <div class="col-md-3 text-center">
            <i class="fas fa-fw fa-stethoscope text-danger fa-4x"></i>
            <h2 class="mt-3">Konsultasi</h2>
            <p class="h5">Lakukan konsultasi di Website.</p>
        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection
