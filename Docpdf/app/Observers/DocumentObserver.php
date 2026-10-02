<?php

namespace App\Observers;

use App\Models\Documents;
use App\Notifications\FriendDocumentActivity;


class DocumentObserver
{
    /**
     * Handle the Documents "created" event.
     */
      public function created(Documents $document): void
    {
        $this->notifyFriends($document, '作成');
    }

    public function updated(Documents $document): void
    {
        $this->notifyFriends($document, '更新');
    }

    private function notifyFriends(Documents $document, string $action): void
    {
        $owner = $document->user;

        if (!$owner) {
            return;
        }

        $notification = new FriendDocumentActivity(
            $document,
            $action,
            $owner->name
        );

        $owner->friends->each(function ($friend) use ($notification) {
            $friend->notify($notification);
        });
    }
}
