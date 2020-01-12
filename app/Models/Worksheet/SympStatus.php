<?php

namespace App\Models\Worksheet;

use Illuminate\Database\Eloquent\Model;

class SympStatus extends Model
{
    protected $table = 'symp_status';

    protected $primaryKey = 'symp_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'symp_id',
        'symp_name',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
