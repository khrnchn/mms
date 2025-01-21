<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
        'phone',
        'address',
        'date_of_birth',
        'is_admin',
        'gender'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    public function isAdmin(): bool
    {
        return (bool) $this->is_admin;
    }

    public function clubUsers()
    {
        return $this->hasMany(ClubUser::class);
    }

    public function clubs()
    {
        return $this->belongsToMany(Club::class)
            ->withPivot('role', 'joined_at')
            ->withTimestamps();
    }

    public function eventParticipants()
    {
        return $this->hasMany(EventParticipant::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_participants')
        ->withPivot('role', 'joined_at', 'status');
    }
}
