<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user_data = [];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_data = [])
    {
        $this->user_data = $user_data;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("admin@admin.com", config('mail.from.name'))
            ->subject('Forgot Password - ' . config('mail.from.name'))
            ->view('user.mail.forgot-password')
            ->with(['user_data' => $this->user_data]);
    }
}