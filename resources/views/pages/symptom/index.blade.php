@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Gejala</h5>
            <p class="card-description">
                Kelola data gejala secara efektif untuk mendukung diagnosa yang akurat. <br> Tambah, lihat, perbarui, atau hapus informasi gejala untuk memastikan sistem pakar selalu diperbarui dengan informasi terbaru.
            </p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <a href="{{ route('gejala.create') }}"><button class="btn btn-primary me-2">Tambah data</button></a>
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
                            <th scope="col">Kode Gejala</th>
                            <th scope="col">Nama Gejala</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col" width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($symptoms as $key => $symptom)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $symptom->code }}</td>
                                <td>{{ $symptom->name }}</td>
                                <td>{{ $symptom->deskripsi }}</td>
                                <td class="d-flex gap-2"><a href="{{ route('gejala.edit', $symptom->id) }}"><button class="btn btn-light btn-sm">Edit</button></a>
                                    <form action="{{route('gejala.destroy', $symptom->id)}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button onclick="return confirm('apakah anda ingin menghapus data?')" type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
