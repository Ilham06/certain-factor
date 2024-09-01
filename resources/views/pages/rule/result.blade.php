@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Hasil Diagnosa</h5>
            <p class="card-description">
                Berdasarkan gejala yang Anda masukkan dan nilai Certain Factor (CF) yang Anda berikan, berikut adalah hasil
                diagnosa yang menunjukkan tingkat kemungkinan untuk setiap penyakit.
            </p>
            <x-alert-success />
            @foreach ($result as $item)
                <div class="mb-4">
                    <p class="fw-bold">{{ $item['penyakit'] }}</p>
                    <div class="table table-responsive mt-4">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="bg-secondary">
                                    <th scope="col">Gejala</th>
                                    <th scope="col" width="10%">CF User</th>
                                    <th scope="col" width="10%">CF Pakar</th>
                                    <th scope="col" width="10%">CF (H,E)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item['data'] as $key => $item_data)
                                    <tr>
                                        <td scope="row">{{ $key }}</td>
                                        <td>{{ $item_data['CF User'] }}</td>
                                        <td>{{ $item_data['CF Pakar'] }}</td>
                                        <td>{{ $item_data['CF (H,E)'] }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>
                                        <p class="fw-bold">Total Nilai CF</p>
                                    </td>
                                    <td colspan="3">
                                        <p class="fw-bold">{{ $item['cf total'] }}</p>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach

            <hr>
            <p class="fw-bold">Hasil Akhir</p>
            <div class="table table-responsive mt-4">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr class="bg-secondary">
                            <th scope="col">Nama Penyakit</th>
                            <th scope="col" width="10%">CF Total</th>
                            <th scope="col" width="10%">Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $key => $result_value)
                            <tr>
                                <td scope="row">{{ $result_value['penyakit'] }}</td>
                                <td>{{ $result_value['cf total'] }}</td>
                                <td>{{ $result_value['percent'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p>Berdasarkan analisis gejala dan nilai Certain Factor (CF) yang Anda input, kemungkinan terbesar adalah kucing
                Anda mengalami <b>{{ $result[0]['penyakit'] }}</b> dengan nilai CF sebesar
                <b>{{ $result[0]['cf total'] }}</b> atau dengan persentase <b>{{ $result[0]['percent'] }}</b>. Ini menunjukkan tingkat keyakinan yang tinggi terhadap diagnosa ini.
            </p>
        </div>
    </div>
@endsection
