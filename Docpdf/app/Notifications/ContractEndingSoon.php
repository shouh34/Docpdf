<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContractEndingSoon extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    /*
    public function __construct()
    {
        //
    }
*/


    public function __construct(public $document)
     {

     }

    public function via(object $notifiable): array
    {
        // 画面内通知とメールの両方に送る
        return ['database', 'mail'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'document_id' => $this->document->id,
            'title' => $this->document->title,
            'end_date' => $this->document->end_date,
            'message' => '契約終了日が近づいています。',
        ];
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    /*
    public function via(object $notifiable): array
    {
        return ['mail'];
    }
*/
    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('契約終了日のお知らせ')
            ->greeting($notifiable->name . ' さん')
            ->line('契約終了日が近づいている契約書があります。')
            ->line('契約書名：' . $this->document->title)
            ->line('終了日：' . $this->document->end_date)
            ->line('Contract Makerにログインして内容をご確認ください。');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
