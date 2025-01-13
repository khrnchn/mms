<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubUser extends Model
{
    protected $table = "club_user";
    protected $fillable = [
        'club_id', 
        'user_id', 
        'role', 
        'joined_at',
    ];

    protected $dates = ['joined_at'];

    protected $casts = [
        'joined_at' => 'datetime',
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}