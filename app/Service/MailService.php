<?php

namespace App\Service;

use App\Mail\AuthorCommentNotification;
use App\Mail\CommentNotification;
use App\Mail\DocumentNotification;
use App\Mail\InternStatus;
use App\Mail\NewPostNotification;
use App\Mail\Subscribe;
use App\Mail\SuccessUnsubscribe;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Document;
use App\Models\Intern;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use PharIo\Manifest\Author;

class MailService
{
    public function sendEmailRegister(Intern $intern)
    {
        Mail::to($intern->email)->send(new InternStatus($intern, 'pending'));
    }
    public function sendEmailAcceptedIntern(Intern $intern)
    {
        Mail::to($intern->email)->send(new InternStatus($intern, $intern->status));
    }

    public function sendEmailSubscribe(Subscription $subscription)
    {
        Mail::to($subscription->email)->send(new Subscribe($subscription));
    }

    public function sendEmailUnsubscribe($email)
    {
        Mail::to($email)->send(new SuccessUnsubscribe());
    }

    public function sendEmailReSubscribe(Subscription $subscription)
    {
        Mail::to($subscription->email)->send(new Subscribe($subscription));
    }

    public function sendEmailNewPost(Blog $blog)
    {
        $subscribers = Subscription::where('status', 1)->get();

        foreach ($subscribers as $subscription) {
            Mail::to($subscription->email)->send(new NewPostNotification($blog, $subscription));
        }
    }

    public function sendEmailDocument(Intern $intern, Document $document)
    {
        Mail::to($intern->email)->send(new DocumentNotification($intern, $document));
    }

    public function sendEmailAuthorComment(Comment $comment, Blog $blog, User $user)
    {
        $author = $blog->author;
        if ($author) {
            Mail::to($author->email)->send(new AuthorCommentNotification($comment, $blog, $author, $user));
        }
    }
}
