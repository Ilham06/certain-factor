@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit data penyakit</h5>
                    <p class="card-description">
                        Perbarui data penyakit dengan informasi terbaru. Jaga agar basis data Anda selalu relevan dengan menambahkan gejala baru, pengobatan, atau informasi penting lainnya.
                    </p>
                    <form action="{{ route('penyakit.update', $data->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode Penyakit</label>
                            <input name="code" value="{{ $data->code }}" type="text"
                                class="form-control @error('code') is-invalid @enderror" id="code" />
                            @error('code')
                                <div id="" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Penyakit</label>
                            <input name="name" value="{{ $data->name }}" type="text"
                                class="form-control @error('name') is-invalid @enderror" id="name" />
                            @error('name')
                                <div id="" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="" rows="5">
                            {{ $data->deskripsi }}
                           </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
