<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiseaseCreateRequest;
use App\Http\Requests\DiseaseUpdateRequest;
use App\Models\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diseases = Disease::all();

        return view('pages.disease.index', compact('diseases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.disease.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiseaseCreateRequest $request)
    {
        Disease::create($request->all());
        return redirect()->route('penyakit.index')->with('success', 'sukses menambahkan data');
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
    public function edit(string $id)
    {
        $data = Disease::findOrFail($id);
        return view('pages.disease.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiseaseUpdateRequest $request, string $id)
    {
        Disease::findOrFail($id)->update($request->all());
        return redirect()->route('penyakit.index')->with('success', 'sukses mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Disease::destroy($id);
        return redirect()->route('penyakit.index')->with('success', 'sukses menghapus data');
    }
}
