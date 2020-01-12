<?php

namespace App\Models\Status;

use Illuminate\Database\Eloquent\Model;

class WorksheetStatus extends Model
{
    protected $table = 'worksheet_status';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
