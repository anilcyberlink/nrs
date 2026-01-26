<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    protected $table = 'events';
    protected $fillable = ['name','uri','status','is_open','caption','banner','brief','content'];
}
