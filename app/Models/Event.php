<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'location',
        'organizer_id',
        'participants_limit',
    ];

    /**
     * Get the user who organized the event.
     */
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function participants()
    {
        return $this->hasMany(EventParticipant::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_participants')
        ->withPivot('role', 'joined_at', 'status');
    }
}
