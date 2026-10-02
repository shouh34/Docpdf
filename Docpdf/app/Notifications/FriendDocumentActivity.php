<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Documents;


class FriendDocumentActivity extends Notification
{
    use Queueable;

    public function __construct(
        public Documents $document,
        public string $action,
        public string $actorName
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'document_id' => $this->document->id,
            'title' => $this->document->title,
            'action' => $this->action,
            'actor_name' => $this->actorName,
            'message' => "{$this->actorName}さんがドキュメントを{$this->action}しました。",
        ];
    }
}
