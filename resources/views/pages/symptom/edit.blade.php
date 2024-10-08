@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit data gejala</h5>
                    <p class="card-description">
                        Perbarui data gejala dengan informasi terbaru untuk memastikan akurasi sistem pakar. Tambahkan detail baru atau revisi informasi yang ada untuk diagnosis yang lebih tepat.
                    </p>
                    <form action="{{ route('gejala.update', $symptom->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode Gejala</label>
                            <input name="code" value="{{ $symptom->code }}" type="text"
                                class="form-control @error('code') is-invalid @enderror" id="code" />
                            @error('code')
                                <div id="" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Gejala</label>
                            <input name="name" value="{{ $symptom->name }}" type="text"
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
                            {{ $symptom->deskripsi }}
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
