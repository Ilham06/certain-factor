<?php

use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\SymptomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
   Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
   Route::get('gejala', [SymptomController::class, 'index'])->name('gejala.index');
   Route::get('/penyakit', [DiseaseController::class, 'index'])->name('penyakit.index');

   Route::get('diagnosa', [RuleController::class, 'diagnosa'])->name('diagnosa');
   Route::post('diagnosa/process', [RuleController::class, 'process'])->name('diagnosa.process');
});

Route::middleware(['auth', 'admin'])->group(function () {
   Route::resource('user', UserController::class);
   Route::post('user/restore/{id}', [UserController::class, 'restore'])->name('user.restore');

   Route::get('gejala/create', [SymptomController::class, 'create'])->name('gejala.create');
   Route::post('gejala', [SymptomController::class, 'store'])->name('gejala.store');
   Route::get('gejala/{symptom}/edit', [SymptomController::class, 'edit'])->name('gejala.edit');
   Route::put('gejala/{symptom}', [SymptomController::class, 'update'])->name('gejala.update');
   Route::delete('gejala/{symptom}', [SymptomController::class, 'destroy'])->name('gejala.destroy');

   Route::get('rule', [RuleController::class, 'index'])->name('rule.index');
   Route::get('rule/{id}', [RuleController::class, 'create'])->name('rule.create');
   Route::post('rule', [RuleController::class, 'store'])->name('rule.store');

   Route::get('/penyakit/create', [DiseaseController::class, 'create'])->name('penyakit.create');
   Route::post('/penyakit', [DiseaseController::class, 'store'])->name('penyakit.store');
   Route::get('/penyakit/{id}', [DiseaseController::class, 'show'])->name('penyakit.show');
   Route::get('/penyakit/{id}/edit', [DiseaseController::class, 'edit'])->name('penyakit.edit');
   Route::put('/penyakit/{id}', [DiseaseController::class, 'update'])->name('penyakit.update');
   Route::delete('/penyakit/{id}', [DiseaseController::class, 'destroy'])->name('penyakit.destroy');
});
