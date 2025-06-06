<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFeedback extends Model
{
    protected $fillable = [
        'email',
        'subject',
        'rating',
        'message',
    ];
}
