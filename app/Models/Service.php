<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_id',
        'title',
        'slug',
        'description',
        'price',
        'category',
        'image',
        'rating',
        'total_orders',
        'status',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function savedByUsers()
    {
        return $this->belongsToMany(
            User::class,
            'saved_services'
        )->withTimestamps();
    }
}
