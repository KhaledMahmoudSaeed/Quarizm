<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $fillable = [
        'available_spaces',
        'user_id',
        'workshop_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function workshop(): BelongsTo
    {
        return $this->belongsTo(Workshop::class);
    }
}
