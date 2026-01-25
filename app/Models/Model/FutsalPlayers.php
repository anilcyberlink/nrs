<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FutsalPlayers extends Model
{
    use HasFactory;

    protected $fillable=['team_id','identification_number','name','dob','contact','email','image','remarks'];
}
