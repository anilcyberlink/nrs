<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    protected $table = 'event_category';
    protected $fillable = ['name','price','event','status','type'];

}
