<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('disease_symptoms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disease_id')->constrained('diseases')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('symptom_id')->constrained('symptoms')->onDelete('cascade')->onUpdate('cascade'); // Foreign key ke tabel gejala
            $table->float('cf_rule', 8, 2)->nullable(); // Nilai Certainty Factor untuk gejala terkait dengan penyakit
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disease_symptoms');
    }
};
