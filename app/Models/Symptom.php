<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Symptom extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get all of the diseases for the Disease
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function diseases(): HasMany
    {
        return $this->hasMany(DiseaseSymptom::class);
    }

    /**
     * Get the disease associated with the Symptom
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function disease(): HasOne
    {
        return $this->hasOne(DiseaseSymptom::class);
    }
}
