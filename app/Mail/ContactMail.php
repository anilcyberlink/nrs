<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
      // dd($request->all());
        $email = $request->email;
        $name= $request->name;
        $subject= $request->subject;
        $message= $request->message;
        $to='contact@empirelash.com';
        return $this->view('themes.default.mail.contact-message', ['email' => $email,'name'=>$name,'subject'=>$subject,'message'=>$message])->to($to);
    }
}
