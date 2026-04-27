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
        return $this
            ->subject('New Inquiry Received: ' . $service)
            ->view('mail.contact-inquiry');
    }
}
