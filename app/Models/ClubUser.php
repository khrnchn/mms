<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubUser extends Model
{
    // Set the table name explicitly (optional, but recommended for pivot models)
    protected $table = 'club_user';

    // Specify which attributes can be mass assigned
    protected $fillable = [
        'club_id', 
        'user_id', 
        'role', 
        'joined_at',
        'status'
    ];

    // Cast dates to Carbon instances
    protected $dates = ['joined_at'];

    // Define casts for attribute types
    protected $casts = [
        'joined_at' => 'datetime',
    ];

    // Relationship to Club
    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }

    // Relationship to User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scope to filter by specific roles
    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }

    // Helper method to check if user is an admin of the club
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}