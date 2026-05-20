<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ForumCategory;
use Illuminate\Support\Facades\Auth;

class ForumThread extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'views_count',
        'upvotes_count',
        'replies_count',
        'is_pinned',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($thread) {

            $baseSlug = Str::slug($thread->title);

            $slug = $baseSlug;

            $count = 1;

            while (self::where('slug', $slug)->exists()) {

                $slug = $baseSlug . '-' . $count++;

            }

            $thread->slug = $slug;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(
            ForumCategory::class,
            'category_id'
        );
    }

    public function replies()
    {
        return $this->hasMany(
            ForumReply::class,
            'thread_id'
        );
    }

    public function scopePublished($query)
    {
        return $query->where(
            'status',
            'published'
        );
    }

    public function isOwner(): bool
    {
        return Auth::check()
            && Auth::id() === $this->user_id;
    }

    public function getHtmlContentAttribute()
    {
        return Str::markdown(
            $this->content
        );
    }
}
