<?php

namespace App\Models\Worksheet;

use Illuminate\Database\Eloquent\Model;

class Worksheet extends Model
{
    protected $table = 'worksheets';

    protected $primaryKey = 'work_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'work_order_id',
        'work_li_status',
        'work_group_agen_id',
        'work_symptomp',
        'work_klarifikasi',
        'work_tindak_lanjut',
        'work_rekomendasi',
        'work_progres',
        'work_agen',
        'work_status',
        'work_keterangan',
        'created_at',
        'updated_at'
    ];

    public function agen()
    {
        return $this->belongsTo('App\Models\Agent\Agent', 'work_agen', 'agen_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Monitor\Monitor', 'work_order_id', 'order_id')->where('li_status', $this->work_li_status);
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Worksheet\SympStatus', 'work_symptomp', 'symp_id');
    }
}
