<?php

namespace App\Mail;

use App\Models\Intern;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class InternStatus extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $newStatus;
    public $password;
    /**
     * Create a new message instance.
     */
    public function __construct(Intern $data, $newStatus, $password = null)
    {
        //
        $this->data = $data;
        $this->newStatus = $newStatus;
        $this->password = $password;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Informasi Pendaftaran Magang',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.status',
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

    public function build()
    {
        $status = $this->newStatus;
        $message = '';

        if ($status === 'accepted') {
            $message = 'Pendaftaran Anda sebagai pemagang di Kadang Koding telah diterima.';
        } elseif ($status === 'rejected') {
            $message = 'Maaf, pendaftaran Anda sebagai pemagang di Kadang Koding telah ditolak.';
        } else {
            $message = 'Status pendaftaran Anda telah berubah.';
        }

        $mailMessage = (new MailMessage)
            ->subject('Informasi Pendaftaran Magang di Kadang Koding Indonesia')
            ->line('Terimakasih telah mendaftar Magang di Kadang Koding Indonesia, dan berikut kami lampirkan untuk Status Pendaftaran Anda')
            ->line($message)
            ->line('Berikut adalah detail pendaftaran Anda:')
            ->line('Nama: ' . $this->data->full_name)
            ->line('Sekolah: ' . $this->data->school)
            ->line('Sekolah: ' . $this->data->major)
            ->line('Posisi Magang: ' . $this->data->position->name)
            ->line('Tanggal Mulai: ' . $this->data->start_date)
            ->line('Tanggal Selesai: ' . $this->data->end_date)
            ->line('Status: ' . $this->data->status);

            if ($status === 'accepted') {
                // Jika status "diterima", tambahkan informasi akun user
                $mailMessage->line('Berikut adalah detail Akun untuk Login :')
                    ->line('Email: ' . $this->data->email)
                    ->line('Password: ' . $this->password);
            }
            $mailMessage->line('Terima kasih atas pendaftaran Anda.');
            // Tambahkan informasi lainnya sesuai kebutuhan
            return $mailMessage;
    }
}
