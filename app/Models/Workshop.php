<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workshop extends Model
{
    protected $fillable = [
        'title',
        'description',
        'duration',
        'size',
        'date',
        'price',
        'finish',
        'img',
        'user_id',
        'category_id',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
