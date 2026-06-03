<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'seller_id',
        'service_id',
    ];

    public function buyer()
    {
        return $this->belongsTo(
            User::class,
            'buyer_id'
        );
    }

    public function seller()
    {
        return $this->belongsTo(
            User::class,
            'seller_id'
        );
    }

    public function service()
    {
        return $this->belongsTo(
            Service::class
        );
    }

    public function messages()
    {
        return $this->hasMany(
            Message::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    public function lastMessage()
    {
        return $this->hasOne(
            Message::class
        )->latestOfMany();
    }


}
