<?php

namespace App\Mail;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AuthorCommentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;
    public $blog;
    public $author;
    public $user;

    // Konstruktor untuk mengirim data yang diperlukan


    /**
     * Create a new message instance.
     */
    public function __construct(Comment $comment, Blog $blog, User $author, User $user)
    {
        $this->comment = $comment;
        $this->blog = $blog;
        $this->author = $author;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ada Komentar Baru di Artikel Anda!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.author-comment-notification',
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
