<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Runner extends Authenticatable
{
protected $fillable=['reg_no','paid_status','entry_price','ref_id','payment_type','first_name','last_name','gender','blood_group','dob','occupation','nationality','country','city','address','telephone_no','mobile_no','email','facebook_id','past_record','previous_runner','bib_no','event', 'reg_email_status'];

   public function members()
      {
          return $this->hasOne('App\Model\InfoMarathon','user_id');
      }

   public function applicationtype()
      {
          return $this->hasOne('App\Model\AppliactionType','user_id');
      }

   public function emergency()
      {
          return $this->hasOne('App\Model\Emergency','user_id');
      }
   
   public function document()
      {
          return $this->hasOne('App\Model\RunnerDoc','user_id');
      }
}
