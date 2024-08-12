<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ThereIsAnOrder extends Notification
{
    use Queueable;
    protected  $user_name ;
    public $store_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user_name,$store_id)
    {
        $this->user_name = $user_name;
        $this->store_id = $store_id;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
{
    return ['database'];
}

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
{
    return [
        'data' =>'Order frome' . $this->user_name. '.',
        'id' => $this->store_id,
    ];
}
}
