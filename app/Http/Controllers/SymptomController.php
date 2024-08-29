<?php

namespace App\Http\Controllers;

use App\Http\Requests\SymptomCreateRequest;
use App\Http\Requests\SymptomUpdateRequest;
use App\Models\Symptom;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $symptoms = Symptom::all();

        return view('pages.symptom.index', compact('symptoms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.symptom.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SymptomCreateRequest $request)
    {
        Symptom::create($request->all());
        return redirect()->route('gejala.index')->with('success', 'sukses menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Symptom $symptom)
    {
        return view('pages.symptom.edit', compact('symptom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SymptomUpdateRequest $request, Symptom $symptom)
    {
        $symptom->update($request->all());
        return redirect()->route('gejala.index')->with('success', 'sukses mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Symptom $symptom)
    {
        $symptom->delete();
        return redirect()->route('gejala.index')->with('success', 'sukses menghapus data');
    }
}
