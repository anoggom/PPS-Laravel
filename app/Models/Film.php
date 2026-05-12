<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Film extends Model
{
    public function director(): BelongsTo {
        return $this->belongsTo(Director::class);
    }
}
