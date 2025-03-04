<?php

namespace App\Mail\users;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyCodeEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $email;
    public  $code;

    public function __construct($code,$name, $email) {
        $this->name = $name;
        $this->email = $email;
        $this->code = $code;
    }
    public function envelope(): Envelope
    {
        return new Envelope(
        subject: 'Verify Code Email',
        );
    }
    public function content(): Content
    {
        return new Content(
            // htmlString: "Youd Verfy Code <br>" . $this->code
            view: 'mails.verify',
            with: [
                "code" => $this->code,
                'name' => $this->name,
                'email' => $this->email,
                "code_array" => str_split($this->code)
            ]
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
