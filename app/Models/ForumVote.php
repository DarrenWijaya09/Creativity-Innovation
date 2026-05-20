<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumVote extends Model
{
    protected $fillable = [
        'user_id',
        'thread_id',
        'reply_id',
    ];
}
