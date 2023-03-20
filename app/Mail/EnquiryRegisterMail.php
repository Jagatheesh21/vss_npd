<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\EnquiryRegister;

class EnquiryRegisterMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user_email,$user_name,$file,$enquiry;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_email,$user_name,$file,EnquiryRegister $enquiry)
    {
        $this->file = $file;
        $this->user_email = $user_email;
        $this->user_name = $user_name;
        $this->enquiry = $enquiry;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Enquiry Register',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.test',
            with: ['user_name' => $this->user_name,'user_email'=> $this->user_email,'enquiry'=>$this->enquiry],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
            Attachment::fromPath($this->file),
        ];
    }
}
