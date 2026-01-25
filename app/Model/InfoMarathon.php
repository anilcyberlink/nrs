<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InfoMarathon extends Model
{
    protected $fillable=['user_id','event_category','tshirt_size','event']; 

     public function members()
      {
          return $this->belongsTo('App\Model\Runner','user_id');
      }

}
