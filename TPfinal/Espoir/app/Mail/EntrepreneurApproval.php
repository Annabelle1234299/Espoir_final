<?php

namespace App\Mail;

use App\Models\Stand;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EntrepreneurApproval extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * L'entrepreneur
     */
    public $user;
    
    /**
     * Le stand approuvé
     */
    public $stand;
    
    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Stand $stand)
    {
        $this->user = $user;
        $this->stand = $stand;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Félicitations ! Votre stand a été approuvé - Espoir',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.entrepreneur-approval',
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
