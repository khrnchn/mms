<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Club extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'location',
        'established_date',
        'contact_email',
        'contact_phone',
        'is_active',
        'participants_limit',
    ];

    protected $dates = ['established_date', 'deleted_at'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role', 'joined_at')
            ->withTimestamps();
    }

    public function clubUsers(): HasMany
    {
        return $this->hasMany(ClubUser::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
