@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <x-alert-success />
                    <h5 class="card-title">Buat Rule untuk flue kucing</h5>
                    <p class="card-description">
                        Sesuaikan rule diagnosa berdasarkan informasi terkini dan pengalaman medis. Perbarui hubungan antara
                        gejala dan penyakit, serta atur ulang nilai Certain Factor (CF) untuk memastikan sistem pakar selalu
                        memberikan diagnosa yang akurat dan dapat dipercaya.
                    </p>
                    <form action="{{ route('rule.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="disease_id" value="{{ request()->route('id') }}">
                        <div class="">
                            @foreach ($symptoms as $symptom)
                                <div class="mb-3">
                                    <label for="code" class="form-label">CF {{ $symptom->name }}</label>
                                    <div class="row items-center">
                                        <div class="col-5">
                                            <select name="cf[{{ $symptom->id }}][value]" class="form-select">
                                                @foreach (config('general.cf_term') as $key => $term)
                                                    <option @selected($symptom->disease && $term == $symptom->disease->cf_rule) value="{{ $term }}">
                                                        {{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3"><input @checked($symptom->disease)
                                                name="cf[{{ $symptom->id }}][is_check]" class="form-check-input"
                                                type="checkbox" id="">

                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
