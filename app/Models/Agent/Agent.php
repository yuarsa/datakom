<?php

namespace App\Models\Agent;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $table = 'agents';

    protected $primaryKey = 'agen_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agen_name', 'agen_email', 'agen_phone', 'agen_address', 'agen_grpagen_id'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function kelompok()
    {
        return $this->belongsTo('App\Models\Agent\AgentGroup', 'agen_grpagen_id', 'grpagen_id');
    }
}
