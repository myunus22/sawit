<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rehabilitation extends Model
{
    protected $fillable = [
        'disease_id',
        'age_category_id',
        'fertilizer_type',
        'dosage',
        'unit',
        'instructions'
    ];

    public function disease(): BelongsTo
    {
        return $this->belongsTo(Disease::class);
    }

    public function ageCategory(): BelongsTo
    {
        return $this->belongsTo(AgeCategory::class);
    }
}
