<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Emergency extends Model
{
    protected $fillable=['user_id','name','relation','group_type','telephone','phone'];
}
