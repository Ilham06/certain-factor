@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah data penyakit baru</h5>
                    <p class="card-description">
                        Masukkan informasi penyakit baru untuk memperkaya basis data diagnosa Anda. 
                        Pastikan data yang akurat untuk mendukung hasil diagnosa yang lebih tepat.
                    </p>
                    <form action="{{ route('penyakit.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode Penyakit</label>
                            <input name="code" type="text" class="form-control @error('code') is-invalid @enderror"
                                id="code" />
                            @error('code')
                                <div id="" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Penyakit</label>
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" />
                            @error('name')
                                <div id="" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="" cols="30" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
