<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\NexmoMessage;

class SMSConfirmation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['nexmo'];
    }

    public function toNexmo($notifiable)
    {
        $part_one = substr($notifiable->sms_verify_code, 0, 3);
        $part_two = substr($notifiable->sms_verify_code, 3);
        return (new NexmoMessage)
                    ->content("Your SMS verification code is PDP-$part_one-$part_two");
    }
}
