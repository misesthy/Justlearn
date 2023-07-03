<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class AssignedTicketNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $ticket;

    public function __construct(Ticket $ticket) {
        $this->ticket = $ticket;
    }

    public function build(){
        return $this->title($this->ticket->subject)
                    ->view('emails.ticket_notification')
                    ->with([
                        'ticket' => $this->ticket
                    ]);
    }

    public function via($notifiable): array
    {
        if (config('app.enable_notifications')) {
            return ['mail'];
        }

        return [];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('You have been assigned a new ticket')
            ->line('You have been assigned a new ticket: ' . $this->ticket->title)
            ->action('View ticket', route('tickets.show', $this->ticket))
            ->line('Thank you!');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
