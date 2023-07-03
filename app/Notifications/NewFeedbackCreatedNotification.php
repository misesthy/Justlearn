<?php

namespace App\Notifications;

use App\Models\Feedback;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewFeedbackCreatedNotification extends Notification
{
    public function __construct(protected Feedback $feedback) {}

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
            ->subject('New feedback')
            ->line('New feedback have been created: ' . $this->feedback->title)
            ->action('View feedback', route('feedbacks.show', $this->feedback))
            ->line('Thank you!');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
