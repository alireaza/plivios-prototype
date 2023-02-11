<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Response extends Model
{
    protected $fillable = [
        'reference_type',
        'reference_id',
        'method',
        'url',
        'payload',
        'status_code',
        'status_text',
        'contents',
    ];

    protected $casts = [
        'reference_id' => 'integer',
        'payload' => 'array',
        'status_code' => 'integer',
    ];

    public function reference(): MorphTo
    {
        return $this->morphTo();
    }
}
