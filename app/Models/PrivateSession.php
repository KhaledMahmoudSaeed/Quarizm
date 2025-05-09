<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrivateSession extends Model
{
    protected $fillable = [
        'date',
        'coach_id',
        'coachee_id',
        'created_at'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
