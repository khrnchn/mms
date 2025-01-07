<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'forum_id',
        'user_id',
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    // A topic belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A topic has many replies
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}

