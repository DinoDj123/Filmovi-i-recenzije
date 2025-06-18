<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
 use Illuminate\Support\Str;

class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory;
    
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'review',
        'picture',
        'rating',
        'published_at',
        'created_at',
        'updated_at',
        'user_id'
    ];

    public function user(): BelongsTo  
    {
        return $this->belongsTo(User::class);
    }

   

    protected static function booted(){
        Movie::saving(function ($movie) {
            if (!$movie->slug || $movie->isDirty('title')) {
                $slug = Str::slug($movie->title);
                $count = 2;
                $baseSlug = $slug;

                while (static::where('slug', $slug)->where('id', '!=', $movie->id)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }

                $movie->slug = $slug;
            }
        });
    }
}