<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FutsalEvent extends Model 
{
    use HasFactory;

     protected $table = 'futsal_events';
    protected $fillable = ['event_name','price','status','banner','brief','content'];
}
