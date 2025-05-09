<?php

namespace App\Observers;

use App\Models\Notification;
use App\Services\OneSignalService;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class NotificationObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Notification "created" event.
     */
    public function created(Notification $notification): void
    {
        app(OneSignalService::class)->sendPush(
            $notification->title,
            $notification->message
        );
    }
}
