<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderIsReady extends Notification
{
    use Queueable;
    protected  $name ;
    protected $store_name ;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name,$store_name)
    {
        $this->name = $name;
        $this->store_name = $store_name;
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
        'data' =>'Order '. $this->name. ' Is Ready From '. $this->store_name. '.'
    ];
}
}
