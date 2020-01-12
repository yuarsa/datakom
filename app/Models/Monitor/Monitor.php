<?php

namespace App\Models\Monitor;

use App\Traits\CompositeKeyTrait;
use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    use CompositeKeyTrait;

    protected $table = 'monitoring';

    protected $primaryKey = ['order_id', 'li_status'];

    public $incrementing = false;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'group_id',
        'status_id',
        'last_refresh',
        'nama_bc',
        'order_sub_type',
        'li_sid',
        'custanum',
        'li_id',
        'li_product_name',
        'kelompok_product',
        'new_bandwidth',
        'li_milestone',
        'ncx_milestone',
        'li_status',
        'biaya_pasang',
        'hrg_bulanan',
        'harga_total',
        'last_update',
        'billcomp_update',
        'billcomp_kategori',
        'segmen',
        'witel',
        'regional',
        'li_createdby_name',
        'order_created_date',
        'usia_order',
        'kategori_usia_order',
        'tahun_created_order',
        'description_wfm',
        'status_wfm',
        'ownergroup_wfm',
        'wonum',
        'provcom_date',
    ];

    public function worksheet()
    {
        return $this->belongsTo('App\Models\Worksheet\Worksheet', 'order_id', 'work_order_id');
    }

    public function group()
    {
        return $this->belongsTo('App\Models\Agent\AgentGroup', 'group_id', 'grpagen_id');
    }
}
