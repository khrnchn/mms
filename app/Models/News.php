<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'author_id',
        'status',
        'featured',
        'published_at'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (! $news->slug) {
                $news->slug = Str::slug($news->title);
            }

            $user = auth()->user();
            if ($user) {
                $news->author_id = $user->id;
            }
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
