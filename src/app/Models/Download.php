<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Download extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'url',
        'type',
        'frequency',
        'last_run_at',
    ];

    protected $casts = [
        'frequency' => 'integer',
        'last_run_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function responses(): MorphMany
    {
        return $this->morphMany(Response::class, 'reference');
    }
}
