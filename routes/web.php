<?php

use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\SymptomController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('penyakit', DiseaseController::class);

Route::get('gejala', [SymptomController::class, 'index'])->name('gejala.index');
Route::get('gejala/create', [SymptomController::class, 'create'])->name('gejala.create');
Route::post('gejala', [SymptomController::class, 'store'])->name('gejala.store');
Route::get('gejala/{symptom}/edit', [SymptomController::class, 'edit'])->name('gejala.edit');
Route::put('gejala/{symptom}', [SymptomController::class, 'update'])->name('gejala.update');
Route::delete('gejala/{symptom}', [SymptomController::class, 'destroy'])->name('gejala.destroy');

Route::get('rule', [RuleController::class, 'index'])->name('rule.index');
Route::get('rule/{id}', [RuleController::class, 'create'])->name('rule.create');
Route::post('rule', [RuleController::class, 'store'])->name('rule.store');
Route::get('diagnosa', [RuleController::class, 'diagnosa'])->name('diagnosa');
Route::post('diagnosa/process', [RuleController::class, 'process'])->name('diagnosa.process');
