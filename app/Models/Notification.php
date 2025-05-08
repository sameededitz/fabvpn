<?php

namespace App\Models;

use App\Observers\NotificationObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(NotificationObserver::class)]
class Notification extends Model
{
    protected $fillable = [
        'title',
        'message',
    ];
}
