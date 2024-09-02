<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\DiseaseSymptom;
use App\Models\Symptom;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    public function index(Request $request)
    {
        $selected = $request->get('penyakit');
        $diseases = Disease::all();

        $disease = null;
        if ($selected) {
            $disease = Disease::with('symptoms')->whereName($selected)->first();
        }
        // dd($disease);

        return view('pages.rule.index', compact('diseases', 'disease'));
    }

    public function create($id)
    {

        $symptoms = Symptom::with(['disease' => function ($query) use ($id) {
            $query->where('disease_id', $id);
        }])->get();
        return view('pages.rule.create', compact('symptoms'));
    }

    public function store(Request $request)
    {
        $id = $request->disease_id;
        foreach ($request->cf as $key => $cf) {
            if (data_get($cf, 'is_check')) {
                DiseaseSymptom::updateOrCreate([
                    'disease_id' => $id,
                    'symptom_id' => $key,
                ], [
                    'cf_rule' => $cf['value']
                ]);
            } else {
                $existing = DiseaseSymptom::whereDiseaseId($id)->whereSymptomId($key)->first();
                if ($existing) {
                    $existing->delete();
                }
            }
        }

        return redirect('/rule/' . $id)->with('success', 'sukses menperbaharui data');
    }

    public function diagnosa(Request $request)
    {
        $symptoms = Symptom::all();
        return view('pages.rule.diagnosa', compact('symptoms'));
    }

    public function process(Request $request)
    {
        // Mengambil data CF user dari request
        $cf_user = $request->cf_user;

        // Jika tidak ada gejala yang dipilih, redirect ke halaman diagnosa dengan pesan
        if (!$cf_user) {
            return redirect()->route('diagnosa')->with('success', 'harap masukan pilih gejala yang sesuai agar dapat melakukan diagnosa');
        }

        // Mengambil semua penyakit beserta gejalanya dari database
        $diseases = Disease::with('symptoms')->get();
        $cf = [];
        $result = [];

        // Iterasi melalui setiap penyakit
        foreach ($diseases as $key => $disease) {

            // Iterasi melalui setiap gejala dari penyakit tersebut
            foreach ($disease->symptoms as $key => $value) {
                // Jika ID gejala ada dalam data CF user
                if (array_key_exists($value->symptom_id, $cf_user)) {

                    // Menghitung CF (H,E) dengan rumus CF Pakar * CF User
                    $cfhe = $value->cf_rule * $cf_user[$value->symptom_id];

                    // Menyimpan data ke dalam array result
                    $result[$disease->name]['penyakit'] = $disease->name;
                    $result[$disease->name]['data'][$value->symptom->name]['CF User'] = $cf_user[$value->symptom_id];
                    $result[$disease->name]['data'][$value->symptom->name]['CF Pakar'] = $value->cf_rule;
                    $result[$disease->name]['data'][$value->symptom->name]['CF (H,E)'] = $cfhe;
                }
            }
        }

        // Iterasi melalui setiap hasil perhitungan CF
        foreach ($result as $key => $result_disease) {

            $i = 0;
            $currentValue = 0;

            // Iterasi melalui data gejala dari penyakit
            foreach ($result_disease['data'] as $key => $value_disease) {
                // Mendapatkan nilai gejala berikutnya
                $nextValue = next($result_disease['data']);
                $cf = $value_disease['CF (H,E)'];
                $cf_total = 0;

                // Jika iterasi pertama, hitung CF total dengan rumus
                if ($i == 0) {
                    // Jika tidak ada gejala berikutnya, redirect dengan pesan
                    if (!$nextValue) {
                        return redirect()->route('diagnosa')->with('success', 'harap masukan lebih banyak gejala untuk hasil diagnosa yang lebih akurat');
                    }
                    // Menghitung CF total untuk iterasi pertama
                    $calculate = $cf + $nextValue['CF (H,E)'] * (1 - $cf);
                    $currentValue = $calculate;
                    $i++;
                } else {
                    // Untuk iterasi berikutnya, hitung CF total dengan rumus
                    if ($i != 1) {
                        $calculate = $cf + $currentValue * (1 - $cf);
                        $currentValue = $calculate;
                        $i++;
                    }
                    $i++;
                }
                $cf_total = $calculate;

                // Menyimpan CF total dan persentase ke dalam array result
                $result[$result_disease['penyakit']]['cf total'] = round($cf_total, 3);
                $result[$result_disease['penyakit']]['percent'] = number_format(round($cf_total, 3) * 100, 1) . '%';
            }
        }

        // Mengurutkan hasil berdasarkan CF total secara menurun
        usort($result, function ($a, $b) {
            return $b['cf total'] <=> $a['cf total'];
        });

        // Mengembalikan tampilan dengan data hasil diagnosa
        return view('pages.rule.result', compact('result'));
    }
}
