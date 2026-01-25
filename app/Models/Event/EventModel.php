<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    protected $table = 'events';
    protected $fillable = ['name','uri','status','caption','banner','brief','content'];
}
