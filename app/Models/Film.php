<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['title', 'release_date', 'sinopsis', 'duration', 'gendre', 'director_id'])]
class Film extends Model
{
    use HasFactory;

    public function director(): BelongsTo
    {
        return $this->belongsTo(Director::class);
    }
}
