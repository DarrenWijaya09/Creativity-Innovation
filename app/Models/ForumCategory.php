<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ForumCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'color',
        'icon',
        'description',
        'is_active',
    ];

    public function threads()
    {
        return $this->hasMany(
            ForumThread::class,
            'category_id'
        );
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
