<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'gender',
        'phone',
        'country',
        'img',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function workshops(): HasMany
    {
        return $this->hasMany(Workshop::class);
    }
    public function privateSession(): HasMany
    {
        return $this->hasMany(PrivateSession::class);
    }
    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }
    public function isAdmin(): bool
    {
        return $this->role === "Admin";
    }
    public function isCoach(): bool
    {
        return $this->role === "Coach";
    }
    public function isCoachee(): bool
    {
        return $this->role === "Coachee";
    }
}
