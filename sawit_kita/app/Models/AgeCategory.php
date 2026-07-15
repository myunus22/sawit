<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AgeCategory extends Model
{
    protected $fillable = ['label', 'min_age_months', 'max_age_months'];

    public function rehabilitations(): HasMany
    {
        return $this->hasMany(Rehabilitation::class);
    }

    public function diagnoses(): HasMany
    {
        return $this->hasMany(Diagnosis::class);
    }
}
