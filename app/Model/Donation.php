<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable=['invoice_no','full_name','mobile_no','amount','user_id','file'];
}
