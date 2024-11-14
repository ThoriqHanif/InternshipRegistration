<?php

namespace App\Mail;

use App\Models\Document;
use App\Models\Intern;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DocumentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $intern;
    public $document;

    /**
     * Create a new message instance.
     */
    public function __construct(Intern $intern, Document $document)
    {
        $this->intern = $intern;
        $this->document = $document;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ada Dokumen Baru untuk Kamu!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.document-notification',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
