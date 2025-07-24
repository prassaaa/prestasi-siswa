<?php

namespace App\Mail;

use App\Models\Lomba;
use App\Models\Siswa;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LombaNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $lomba;
    public $siswa;

    /**
     * Create a new message instance.
     */
    public function __construct(Lomba $lomba, Siswa $siswa)
    {
        $this->lomba = $lomba;
        $this->siswa = $siswa;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pemberitahuan Lomba Baru: ' . $this->lomba->nama_lomba,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.lomba.notification',
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