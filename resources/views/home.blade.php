@extends('layouts.app')

@section('content')
    <x-alert-error />
    <div class="card text-start">
        <div class="card-body">
            <h5 class="card-title">Sistem Pakar Diagnosa Penyakit.</h5>
            <p class="card-text">Hallo <span class="fw-bold">{{ auth()->user()->name }}</span>, <br> selamat datang kembali di
                Aplikasi Diagnosa Penyakit.</p>
            <p class="card-text">
                Aplikasi ini dirancang untuk membantu Anda diagnosa kesehatan dengan lebih baik. Dengan memasukkan gejala yang anda alami, sistem pakar kami akan menganalisis dan memberikan kemungkinan diagnosa menggunakan metode Certain Factor (CF). Aplikasi ini memberikan hasil diagnosa yang cepat, akurat, dan dapat diandalkan sesuai dengan keterangan para ahli.
            </p>
        </div>
    </div>
@endsection
