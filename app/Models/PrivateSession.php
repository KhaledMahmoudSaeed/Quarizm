<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrivateSession extends Model
{
    protected $fillable = [
        'date',
        'price',
        'coach_id',
        'coachee_id',
        'created_at'
    ];
    public function coach(): BelongsTo
    {
        return $this->belongsTo(User::class, "coach_id");
    }
    public function coachee(): BelongsTo
    {
        return $this->belongsTo(User::class, "coachee_id");
    }
}
