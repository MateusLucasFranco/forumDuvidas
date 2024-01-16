<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use stdClass;

class SupportRepliedMail extends Mailable implements ShouldQueue {
    use Queueable, SerializesModels;

    public function __construct(
        protected stdClass $reply,
    ) {}

    public function envelope(): Content {
        return new Content(
            markdown: 'emails.support.replied',
            with: [
                'reply' => $this->reply,
            ]
        );
    }

    public function attachments(): array {
        return [];
    }
}