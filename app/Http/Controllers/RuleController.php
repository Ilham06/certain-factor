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
        $symptoms = Symptom::with(['disease' => function($query) {
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
                ],[
                    'cf_rule' => $cf['value']
                ]);
            } else {
                $existing = DiseaseSymptom::whereDiseaseId($id)->whereSymptomId($key)->first();
                if ($existing) {
                    $existing->delete();
                }
            }
        }

        return redirect('/rule/'.$id)->with('success', 'sukses menperbaharui data');
    }
}
