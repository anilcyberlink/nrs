<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FutsalTeam extends Model
{
    use HasFactory;
    protected $table = 'futsal_teams';
    protected $fillable = ['event_id','ref_id','entry_price','paid_status','team_name','company_name','team_captain','contact','email'];

    public function players()
    {
      return $this->hasMany('App\Models\Model\FutsalPlayers','team_id');

    }
}
