<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Disease extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get all of the symptoms for the Disease
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function symptoms(): HasMany
    {
        return $this->hasMany(DiseaseSymptom::class);
    }
}
