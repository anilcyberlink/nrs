<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ApplicationType extends Model
{
protected $fillable=['user_id','individual_entry','group_entry','group_name','group_size','group_type']; 
}
