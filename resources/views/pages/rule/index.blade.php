@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Rule Diagnosa</h5>
            <p class="card-description">
                Eksplorasi hubungan antara gejala dan penyakit yang didukung oleh sistem pakar. <br>
                Lihat nilai Certain Factor (CF) untuk setiap rule, yang menunjukkan tingkat keyakinan pakar terhadap diagnosa yang dihasilkan.
            </p>
            <x-alert-success />
            <div class="">
                <div class="mb-3">
                    <div class="">
                        <label for="name" class="form-label">Pilih penyakit</label>
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col">
                                    <select name="penyakit" class="form-select">
                                        @foreach ($diseases as $item)
                                            <option @selected(request()->get('penyakit') == $item->name) value="{{ $item->name }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if ($disease)
                    <div class="">
                        <ul class="">
                            <li>Nama Penyakit : {{ $disease->name }}</li>
                            <li>Kode : {{ $disease->code }}</li>
                            <li>Jumlah gejala yang terkait : {{count($disease->symptoms)}}</li>
                        </ul>
                        <a href="{{ route('rule.create', $disease->id) }}"><button class="btn btn-secondary mt-4">Update</button></a>
                        <div class="table-responsive mt-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">#</th>
                                        <th scope="col">Kode Gejala</th>
                                        <th scope="col">Nama Gejala</th>
                                        <th scope="col">CF Pakar</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($disease->symptoms as $key => $item)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $item->symptom->code }}</td>
                                        <td>{{ $item->symptom->name }}</td>
                                        <td>{{ $item->cf_rule }}</td>
                                        <td>-</td>
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
                @else
                    <div class="alert alert-danger">Silahkan pilih data penyakit terlebih dahulu</div>
                @endif
            </div>
        </div>
    </div>
@endsection
