<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Provider;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'auth_provider',
        'avatar',
        'birth_date',
        'phone',
        'role',
        'location',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birth_date' => 'date',
    ];

    public function provider()
    {
        return $this->hasOne(Provider::class);
    }

    public function getInitialsAttribute(): string
    {
        return collect(explode(' ', $this->name))
            ->map(fn($word) => strtoupper(substr($word, 0, 1)))
            ->take(2)
            ->implode('');
    }

    public function getAvatarUrlAttribute(): ?string
    {
        if (!$this->avatar) {
            return null;
        }

        return str_starts_with($this->avatar, 'http')
            ? $this->avatar
            : asset('storage/' . $this->avatar);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function buyerConversations()
    {
        return $this->hasMany(
            Conversation::class,
            'buyer_id'
        );
    }

    public function sellerConversations()
    {
        return $this->hasMany(
            Conversation::class,
            'seller_id'
        );
    }

    public function messages()
    {
        return $this->hasMany(
            Message::class,
            'sender_id'
        );
    }
}
