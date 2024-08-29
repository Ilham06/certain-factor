@extends('layouts.app')

@section('content')
    <x-alert-error />
    <div class="card text-start">
        <div class="card-body">
            <h5 class="card-title">Klasifikasi Naive Bayes</h5>
            <p class="card-text">Hallo <span class="fw-bold">{{ auth()->user()->name }}</span>, <br> selamat datang kembali di
                aplikasi Klasifikasi Naive Bayes</p>
            <p class="card-text">
                Naive Bayes adalah salah satu algoritma yang digunakan dalam machine learning untuk klasifikasi. Algoritma ini didasarkan pada Teorema Bayes, yang memberikan cara untuk menghitung probabilitas posterior dari sebuah hipotesis berdasarkan prior probability dan likelihood dari data. 
            </p>
            <p class="card-text">
                Aplikasi Naive Bayes ini sudah flexible digunakan untuk segala jenis study kasus untuk klasifikasi dengan persyaratan tertentu. Selain itu, dalam perhitungannya sudah cukup lengkap dalam setiap iterasinya, dan juga sudah menerapkan <i>Laplacian Correction</i> untuk menghindari probabilitas 0 (nol).
            </p>
            
        </div>
    </div>
@endsection
