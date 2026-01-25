<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RunnerDoc extends Model
{
   protected $table = 'runner_document';
   protected $fillable=['user_id','file']; 
}
