<?php

namespace App\Observers;

use App\Models\User;
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
        $users = User::whereNotNull('onesignal_player_id')->get();

        $playerIds = $users->pluck('onesignal_player_id')->toArray();

        if (!empty($playerIds)) {
            app(OneSignalService::class)->sendPush(
                $notification->title,
                $notification->message,
                $playerIds
            );
        }
    }
}
