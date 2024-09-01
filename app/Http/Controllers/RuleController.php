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

    public function create()
    {
        $symptoms = Symptom::with(['disease' => function ($query) {
            $query->where('disease_id', 1);
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
        $cf_user = $request->cf_user;
        $diseases = Disease::with('symptoms')->get();
        $cf = [];
        $result = [];
        foreach ($diseases as $key => $disease) {

            foreach ($disease->symptoms as $key => $value) {
                if (array_key_exists($value->symptom_id, $cf_user)) {

                    $cfhe = $value->cf_rule * $cf_user[$value->symptom_id];
                    # code...
                    $result[$disease->name]['penyakit'] = $disease->name;
                    $result[$disease->name]['data'][$value->symptom->name]['CF User'] = $cf_user[$value->symptom_id];
                    $result[$disease->name]['data'][$value->symptom->name]['CF Pakar'] = $value->cf_rule;
                    $result[$disease->name]['data'][$value->symptom->name]['CF (H,E)'] = $cfhe;
                }
            }
        }

        foreach ($result as $key => $result_disease) {

            $i = 0;
            $currentValue = 0;
            foreach ($result_disease['data'] as $key => $value_disease) {
                $nextValue = next($result_disease['data']);
                $cf = $value_disease['CF (H,E)'];
                $cf_total = 0;
                if ($i == 0) {
                    $calculate = $cf + $nextValue['CF (H,E)'] * (1 - $cf);
                    $currentValue = $calculate;
                    $i++;
                    
                } else {
                    if ($i != 1) {
                       $calculate = $cf + $currentValue * (1-$cf);
                       $currentValue = $calculate;
                       $i++;
                    }
                    $i++;
                }
                $cf_total = $calculate;
                $result[$result_disease['penyakit']]['cf total'] = round($cf_total, 3);
                $result[$result_disease['penyakit']]['percent'] = number_format(round($cf_total, 3) * 100, 1) . '%';
            }
        }

        usort($result, function ($a, $b) {
            return $b['cf total'] <=> $a['cf total'];
        });
       
        return view('pages.rule.result', compact('result'));
    }
}
