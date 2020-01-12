<?php

namespace App\Models\Regional;

use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
    protected $table = 'regionals';

    protected $primaryKey = 'reg_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reg_name',
        'reg_display_name',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
