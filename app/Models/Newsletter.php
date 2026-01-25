<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{

    protected $fillable=['title','news_content','publish_date'];
}
