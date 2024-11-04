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
    ];

    /**
     * Get the user who organized the event.
     */
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }
}
