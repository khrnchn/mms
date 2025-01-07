<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'topic_id',
    ];

    // A reply belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A reply belongs to a topic
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
