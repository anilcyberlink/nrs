<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\Model\Runner;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AssignRegNoMail extends Mailable
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
    $data = Runner::where('id', $request->id)->first();
    $full_name = $data->first_name .' '. $data->last_name  ;

    $reg_no = $request->id;

   
    return $this->view('themes.default.mail.assign-reg-no', ['full_name' => $full_name, 'reg_no' => $reg_no])->subject('One Run Registration');
  }
}
