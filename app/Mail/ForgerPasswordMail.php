<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgerPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $reset_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$reset_code)
    {
        $this->name=$name;
        $this->reset_code=$reset_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.forget_password_mail')->with([
            'name'=>$this->name,
            'reset_code'=>$this->reset_code
        ]);
    }
}
