@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Penyakit</h5>
            <p class="card-description">
                Kelola daftar penyakit dengan mudah dan efisien. Tambah, perbarui, <br> dan hapus data penyakit untuk memastikan
                informasi diagnosa selalu akurat dan up-to-date.
            </p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <a href="{{ route('penyakit.create') }}"><button class="btn btn-primary me-2">Tambah data</button></a>
                </div>
                <form action="">
                    <input type="text" id="" class="form-control" placeholder="cari data ...">
                </form>
            </div>
            <x-alert-success />
            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col">Kode Penyakit</th>
                            <th scope="col">Nama Penyakit</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col" width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($diseases as $key => $disease)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $disease->code }}</td>
                                <td>{{ $disease->name }}</td>
                                <td>{{ $disease->deskripsi }}</td>
                                <td class="d-flex gap-2"><a href="{{ route('penyakit.edit', $disease->id) }}"><button
                                            class="btn btn-light btn-sm">Edit</button></a>
                                    <form action="{{ route('penyakit.destroy', $disease->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button onclick="return confirm('apakah anda ingin menghapus data?')" type="submit"
                                            class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
