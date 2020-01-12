<?php

namespace App\Models\Agent;

use Illuminate\Database\Eloquent\Model;

class AgentGroup extends Model
{
    protected $table = 'agent_groups';

    protected $primaryKey = 'grpagen_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'grpagen_name',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
