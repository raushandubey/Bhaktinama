<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class NewPanditRegistration extends Notification implements ShouldQueue
{
    use Queueable;

    protected $pandit;

    public function __construct(User $pandit)
    {
        $this->pandit = $pandit;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Pandit Registration - ' . $this->pandit->name)
            ->greeting('Hello Admin!')
            ->line('A new Pandit has registered on Bhaktinama.')
            ->line('Pandit Details:')
            ->line('Name: ' . $this->pandit->name)
            ->line('Email: ' . $this->pandit->email)
            ->line('Mobile: ' . $this->pandit->mobile)
            ->line('Address: ' . $this->pandit->address)
            ->line('Date of Birth: ' . $this->pandit->dob)
            ->action('View Pandit Dashboard', url('/pandit/dashboard'))
            ->line('Please review their details and take necessary action.');
    }
} 