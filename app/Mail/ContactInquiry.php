<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactInquiry extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $data) {}

    public function build(): static
    {
        $service = $this->data['subject'] ?? $this->data['message'] ?? 'General Inquiry';

        $this->subject('New Inquiry Received: ' . $service)
            ->view('mail.contact-inquiry');

        // Let the recipient hit "Reply" and reach the person who submitted the form.
        $email = $this->data['email'] ?? null;
        if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->replyTo($email, $this->data['name'] ?? null);
        }

        return $this;
    }
}
