@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Diagnosa</h5>
            <p class="card-description">
                Di bawah ini, Anda akan menemukan daftar gejala umum yang dapat terjadi pada berbagai penyakit. Silakan
                masukkan keyakinan untuk setiap gejala sesuai dengan intensitas atau tingkat keparahan yang Anda amati.
                Tingkat keyakinan yang Anda berikan akan digunakan untuk menganalisis dan memberikan rekomendasi diagnosa
                yang lebih akurat.
            </p>
            <x-alert-success />
            <form class="" method="POST" action="{{route('diagnosa.process')}}">
                @csrf
                <div class="table-responsive mt-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" width="5%">#</th>
                                <th scope="col" width="15%">Kode Gejala</th>
                                <th scope="col">Nama Gejala</th>
                                <th scope="col" width="20%">Keyakinan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($symptoms as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <select name="cf_user[{{$item->id}}]" class="form-select">
                                            <option value="" disabled selected>Pilih Keyakinan</option>
                                            @foreach (config('general.cf_term') as $key => $term)
                                                <option value="{{ $term }}">
                                                    {{ $key }}</option>
                                            @endforeach
                                        </select>
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
                <button class="btn btn-success mt-4" type="submit">Buat Diagnosa</button>
            </form>
        </div>
    </div>
@endsection
