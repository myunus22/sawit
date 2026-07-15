<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Disease extends Model
{
    protected $fillable = ['name', 'description', 'symptoms', 'prevention'];

    public function rehabilitations(): HasMany
    {
        return $this->hasMany(Rehabilitation::class);
    }

    public function diagnoses(): HasMany
    {
        return $this->hasMany(Diagnosis::class);
    }
}
