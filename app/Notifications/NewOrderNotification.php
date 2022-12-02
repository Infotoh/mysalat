<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
      use Queueable;

      private $details;


      public function __construct($details)

      {

          $this->details = $details;

      }

      public function via($notifiable)

      {

          return ['database'];
          // return ['mail','database'];

      }



      public function toMail($notifiable)

      {

          return (new MailMessage)

                      ->greeting($this->details['greeting'])

                      ->line($this->details['body'])

                      ->action($this->details['actionText'], $this->details['actionURL'])

                      ->line($this->details['thanks']);

      }


      public function toDatabase($details)

      {
        // dd($this->details['event_sort']);
          return [
              'order_id' => $this->details['order_id'],
              'event_sort' => $this->details['event_sort'],
          ];

      }

}
