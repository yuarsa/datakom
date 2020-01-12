<?php

namespace App\Models\Regional;

use Illuminate\Database\Eloquent\Model;

class Witel extends Model
{
    protected $table = 'witels';

    protected $primaryKey = 'witel_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'witel_regional_id',
        'witel_name',
        'witel_display_name',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function regional()
    {
        return $this->belongsTo('App\Models\Regional\Regional', 'witel_regional_id', 'reg_id');
    }
}
