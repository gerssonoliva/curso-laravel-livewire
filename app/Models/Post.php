<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Observers\PostObserver;

#[ObservedBy(PostObserver::class)]

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image_path',
        'excerpt',
        'content',
        'is_published',
        'published_at',
        'user_id',
        'category_id'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacion uno a muchos con Comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relacion muchos a muchos con Tag
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
