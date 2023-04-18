<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\APQPPlanActivity;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user_email,$user_name,$activity,$remarks;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_email,$user_name,APQPPlanActivity $activity,$remarks)
    {
        $this->user_email = $user_email;
        $this->user_name = $user_name;
        $this->activity = $activity;
        $this->remarks = $remarks;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'REG : NPD Activity Verification -'.$this->activity->plan->apqp_timing_plan_number.'-'.$this->activity->plan->sub_stage->name,
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
            view: 'email.verification_mail',
            with:['user_email'=>$this->user_email,'user_name'=>$this->user_name,'activity'=>$this->activity],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
