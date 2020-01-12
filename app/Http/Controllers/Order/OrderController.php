<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agent\Agent;
use App\Models\Agent\AgentGroup;
use App\Models\Monitor\Monitor;
use App\Models\Worksheet\Worksheet;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;
use DB;

class OrderController extends Controller
{
    public function index()
    {
        $user = \Auth::user();

        if($user->hasRole('analis')) {
            $group = AgentGroup::get();

            $segment = Monitor::pluck('segmen', 'segmen')->toArray();
            $regional = Monitor::pluck('regional', 'regional')->toArray();
            $witel = Monitor::pluck('witel', 'witel')->toArray();
            $produk = Monitor::pluck('li_product_name', 'li_product_name')->toArray();
            $usia = Monitor::pluck('kategori_usia_order', 'kategori_usia_order')->toArray();
            $listatus = Monitor::pluck('li_status', 'li_status')->toArray();

            $latest_refresh = Monitor::select('last_refresh')->orderBy('last_refresh', 'DESC')->take(1)->first();

            return view('orders.analis.index', compact('group', 'segment', 'regional', 'witel', 'produk', 'usia', 'listatus', 'latest_refresh'));
        } else if($user->hasRole('agent')) {
            $segment = Monitor::pluck('segmen', 'segmen')->toArray();
            $regional = Monitor::pluck('regional', 'regional')->toArray();
            $witel = Monitor::pluck('witel', 'witel')->toArray();
            $produk = Monitor::pluck('li_product_name', 'li_product_name')->toArray();
            $usia = Monitor::pluck('kategori_usia_order', 'kategori_usia_order')->toArray();
            $listatus = Monitor::pluck('li_status', 'li_status')->toArray();

            return view('orders.agen.index', compact('segment', 'regional', 'witel', 'produk', 'usia', 'listatus'));
        }
    }

    public function analisTable(Request $request)
    {
        if($request->ajax()) {
            $segment_id = $request->segment_id;
            $regional_id = $request->regional_id;
            $witel_id = $request->witel_id;
            $produk_id = $request->produk_id;
            $usia_id = $request->usia_id;
            $listatus_id = $request->listatus_id;

            $select = Monitor::select('monitoring.*', 'worksheets.*', 'agents.agen_name')
                ->leftJoin('worksheets', function($j) {
                    $j->on('monitoring.order_id', '=', 'worksheets.work_order_id')
                        ->on('monitoring.li_status', '=', 'worksheets.work_li_status');
                })
                ->leftJoin('agents', 'worksheets.work_agen', '=', 'agents.agen_id')
                ->where('monitoring.group_id', \Auth::user()->group_id);

            if($segment_id != '') {
                $select = $select->where('monitoring.segmen', $segment_id);
            }

            if($regional_id != '') {
                $select = $select->where('monitoring.regional', $regional_id);
            }

            if($witel_id != '') {
                $select = $select->where('monitoring.witel', $witel_id);
            }

            if($produk_id != '') {
                $select = $select->where('monitoring.li_product_name', $produk_id);
            }

            if($usia_id != '') {
                $select = $select->where('monitoring.kategori_usia_order', $usia_id);
            }

            if($listatus_id != '') {
                $select = $select->where('monitoring.li_status', $listatus_id);
            }

            $select = $select->get();

            $data = Datatables::of($select)
                ->addColumn('group', function($select) {
                    return $select->group->grpagen_name;
                })
                ->addColumn('symptomp', function($select) {
                    return $select->status['symp_name'];
                })
                ->addColumn('klarifikasi', function($select) {
                    return $select->work_klarifikasi;
                })
                ->addColumn('tindaklanjut', function($select) {
                    return $select->work_tindak_lanjut;
                })
                ->addColumn('rekomendasi', function($select) {
                    return $select->work_rekomendasi;
                })
                ->addColumn('progress', function($select) {
                    return $select->work_progres;
                })
                ->addColumn('statusakhir', function($select) {
                    return $select->work_status;
                })
                ->addColumn('keterangan', function($select) {
                    return $select->work_keterangan;
                })
                ->addColumn('agen', function($select) {
                    return $select->agen_name;
                })
                ->addColumn('action', function($select) {
                    if($select->status_id == 0) {
                        $action = '
                            <a href="#" data-id="'.$select->order_id.'" data-listatus="'.$select->li_status.'" class="btn btn-xs btn-info btn-ganti" data-toggle="modal" data-target="#modal-change-group"><i class="fa fa-check-square-o"></i></a>
                        ';
                    } else {
                        $action = '';
                    }

                    return $action;
                })
                ->rawColumns(['group', 'symptomp', 'klarifikasi', 'tindaklanjut', 'rekomendasi', 'progress', 'statusakhir', 'keterangan', 'agen', 'action']);

            return $data->make(true);
        } else {
            return abort('404', 'Upps');
        }
    }

    public function agentTable(Request $request)
    {
        if($request->ajax()) {
            $segment_id = $request->segment_id;
            $regional_id = $request->regional_id;
            $witel_id = $request->witel_id;
            $produk_id = $request->produk_id;
            $usia_id = $request->usia_id;
            $listatus_id = $request->listatus_id;

            $select = Worksheet::select('worksheets.*', 'monitoring.*')
                ->join('monitoring', function($j) {
                    $j->on('worksheets.work_order_id', '=', 'monitoring.order_id')
                        ->on('worksheets.work_li_status', '=', 'monitoring.li_status');
                })->where('worksheets.work_agen', \Auth::user()->agen_id);

            if($segment_id != '') {
                $select = $select->where('monitoring.segmen', $segment_id);
            }

            if($regional_id != '') {
                $select = $select->where('monitoring.regional', $regional_id);
            }

            if($witel_id != '') {
                $select = $select->where('monitoring.witel', $witel_id);
            }

            if($produk_id != '') {
                $select = $select->where('monitoring.li_product_name', $produk_id);
            }

            if($usia_id != '') {
                $select = $select->where('monitoring.kategori_usia_order', $usia_id);
            }

            if($listatus_id != '') {
                $select = $select->where('monitoring.li_status', $listatus_id);
            }

            $select = $select->get();

            $data = Datatables::of($select)
                ->addColumn('nama_bc', function($select) {
                    return $select->nama_bc;
                })
                ->addColumn('order_id', function($select) {
                    return $select->order_id;
                })
                ->addColumn('order_sub_type', function($select) {
                    return $select->order_sub_type;
                })
                ->addColumn('li_product_name', function($select) {
                    return $select->li_product_name;
                })
                ->addColumn('li_milestone', function($select) {
                    return $select->li_milestone;
                })
                ->addColumn('li_status', function($select) {
                    return $select->li_status;
                })
                ->addColumn('harga_total', function($select) {
                    return $select->harga_total;
                })
                ->addColumn('segmen', function($select) {
                    return $select->segmen;
                })
                ->addColumn('witel', function($select) {
                    return $select->witel;
                })                
                ->addColumn('regional', function($select) {
                    return $select->regional;
                })
                ->addColumn('li_createdby_name', function($select) {
                    return $select->li_createdby_name;
                })
                ->addColumn('description_wfm', function($select) {
                    return $select->description_wfm;
                })
                ->addColumn('status_wfm', function($select) {
                    return $select->status_wfm;
                })
                ->addColumn('ownergroup_wfm', function($select) {
                    return $select->ownergroup_wfm;
                })
                ->addColumn('kategori_usia_order', function($select) {
                    return $select->kategori_usia_order;
                })
                ->addColumn('status_id', function($select) {
                    return $select->status_id;
                })
                ->addColumn('group', function($select) {
                    return $select->order['group']['grpagen_name'];
                })
                ->addColumn('symptomp', function($select) {
                    return $select->status['symp_name'];
                })
                ->addColumn('klarifikasi', function($select) {
                    return $select->work_klarifikasi;
                })
                ->addColumn('tindaklanjut', function($select) {
                    return $select->work_tindak_lanjut;
                })
                ->addColumn('rekomendasi', function($select) {
                    return $select->work_rekomendasi;
                })
                ->addColumn('progress', function($select) {
                    return $select->work_progres;
                })
                ->addColumn('statusakhir', function($select) {
                    return $select->work_status;
                })
                ->addColumn('keterangan', function($select) {
                    return $select->work_keterangan;
                })
                ->addColumn('action', function($select) {
                    $action = '
                        <a href="'.url('worksheet/worksheets/' . $select->work_id . '/tindakan').'" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                    ';

                    return $action;
                })
                ->rawColumns([
                    'nama_bc',
                    'order_id',
                    'order_sub_type',
                    'li_product_name',
                    'li_milestone',
                    'li_status',
                    'harga_total',
                    'segmen',
                    'witel',
                    'regional',
                    'li_createdby_name',
                    'description_wfm',
                    'status_wfm',
                    'ownergroup_wfm',
                    'kategori_usia_order',
                    'status_id',
                    'group',
                    'symptomp',
                    'klarifikasi',
                    'tindaklanjut',
                    'rekomendasi',
                    'progress',
                    'statusakhir',
                    'keterangan',
                    'action'
                ]);

            return $data->make(true);
        } else {
            return abort('404', 'Upps');
        }
    }

    public function listToAssign()
    {
        $user = \Auth::user();

        $agent = Agent::where('agen_grpagen_id', $user->group_id)->get();

        $orders = Monitor::where('group_id', $user->group_id)
            ->where('status_id', '=', 0)->get();
			
		$segment = Monitor::pluck('segmen', 'segmen')->toArray();
        $regional = Monitor::pluck('regional', 'regional')->toArray();
        $witel = Monitor::pluck('witel', 'witel')->toArray();
        $produk = Monitor::pluck('li_product_name', 'li_product_name')->toArray();
        $usia = Monitor::pluck('kategori_usia_order', 'kategori_usia_order')->toArray();
        $listatus = Monitor::pluck('li_status', 'li_status')->toArray();

        return view('orders.analis.list_assign', compact('agent', 'orders', 'segment', 'regional', 'witel', 'produk', 'usia', 'listatus'));
    }

    public function listToAssignTable(Request $request)
    {
        if($request->ajax()) {
            $user = \Auth::user();
			
			$segment_id = $request->segment_id;
            $regional_id = $request->regional_id;
            $witel_id = $request->witel_id;
            $produk_id = $request->produk_id;
            $usia_id = $request->usia_id;
            $listatus_id = $request->listatus_id;

            $select = Monitor::where('group_id', $user->group_id)->where('status_id', 0);
			
            if($segment_id != '') {
                $select = $select->where('segmen', $segment_id);
            }

            if($regional_id != '') {
                $select = $select->where('regional', $regional_id);
            }

            if($witel_id != '') {
                $select = $select->where('witel', $witel_id);
            }

            if($produk_id != '') {
                $select = $select->where('li_product_name', $produk_id);
            }

            if($usia_id != '') {
                $select = $select->where('kategori_usia_order', $usia_id);
            }

            if($listatus_id != '') {
                $select = $select->where('li_status', $listatus_id);
            }

            $select = $select->get();

            $data = Datatables::of($select)
                ->addColumn('action', function($select) {
                    return '';
                })
                ->addColumn('group', function($select) {
                    return $select->group->grpagen_name;
                })
                ->rawColumns(['action', 'group']);

            return $data->make(true);
        } else {
            return abort('404', 'Upps');
        }
    }

    public function listChangeGroup()
    {
        $user = \Auth::user();

        $group = AgentGroup::get();

        $orders = Monitor::where('group_id', $user->group_id)
            ->where('status_id', '=', 0)->get();
			
		$segment = Monitor::pluck('segmen', 'segmen')->toArray();
        $regional = Monitor::pluck('regional', 'regional')->toArray();
        $witel = Monitor::pluck('witel', 'witel')->toArray();
        $produk = Monitor::pluck('li_product_name', 'li_product_name')->toArray();
        $usia = Monitor::pluck('kategori_usia_order', 'kategori_usia_order')->toArray();
        $listatus = Monitor::pluck('li_status', 'li_status')->toArray();

        return view('orders.analis.change_group', compact('group', 'orders', 'segment', 'regional', 'witel', 'produk', 'usia', 'listatus'));
    }

    public function listChangeGroupTable(Request $request)
    {
        if($request->ajax()) {
            $user = \Auth::user();
			
			$segment_id = $request->segment_id;
            $regional_id = $request->regional_id;
            $witel_id = $request->witel_id;
            $produk_id = $request->produk_id;
            $usia_id = $request->usia_id;
            $listatus_id = $request->listatus_id;

            $select = Monitor::where('group_id', $user->group_id)->where('status_id', '=', 0);
			
            if($segment_id != '') {
                $select = $select->where('segmen', $segment_id);
            }

            if($regional_id != '') {
                $select = $select->where('regional', $regional_id);
            }

            if($witel_id != '') {
                $select = $select->where('witel', $witel_id);
            }

            if($produk_id != '') {
                $select = $select->where('li_product_name', $produk_id);
            }

            if($usia_id != '') {
                $select = $select->where('kategori_usia_order', $usia_id);
            }

            if($listatus_id != '') {
                $select = $select->where('li_status', $listatus_id);
            }

            $select = $select->get();

            $data = Datatables::of($select)
                ->addColumn('action', function($select) {
                    return '';
                })
                ->addColumn('group', function($select) {
                    return $select->group->grpagen_name;
                })
                ->rawColumns(['action', 'group']);

            return $data->make(true);
        } else {
            return abort('404', 'Upps');
        }
    }

    public function createToAssign(Request $request)
    {
        DB::beginTransaction();

        try {			
            $user = \Auth::user();

            if(!$request->has('work_order_id')) {
                flash('Anda Belum Memilih Order')->success();

                return redirect('order/list-to-assigns');
            }

            foreach ($request->work_order_id as $key => $value) {
                $mon = explode('|', $value);

                if($mon[1] == '') {
                    $mon_1 = '';
                } else {
                    $mon_1 = $mon[1];
                }

                $insert = Worksheet::create([
                    'work_order_id' => $mon[0],
                    'work_li_status' => $mon_1,
                    'work_agen' => $request->work_agen,
                    'work_group_agen_id' => $user->group_id
                ]);

                $updateOrder = Monitor::where('order_id', $mon[0])
                    ->where('li_status', $mon_1)
                    ->update(['status_id' => 1]);
            }

            DB::commit();

            flash('Data berhasil ditambahkan')->success();

            return redirect('order/orders');
        } catch (QueryException $err) {
            DB::rollback();

            flash($err->getMessage() . ' ' . $err->getLine())->error();

            return redirect('order/orders');
        }
    }

    public function updateChangeGroup(Request $request)
    {
        try {
            $user = \Auth::user();

            if(!$request->has('order_id')) {
                flash('Anda Belum Memilih Order')->success();

                return redirect('order/change-group');
            }

            foreach ($request->order_id as $value) {
                $mon = explode('|', $value);

                $update = Monitor::where('order_id', '=', $mon[0])
                    ->where('li_status', '=', $mon[1])
                    ->update(['group_id' => $request->group_id]);
            }

            flash('Data berhasil dirubah')->success();

            return redirect('order/orders');
        } catch (QueryException $err) {
            flash($err->getMessage() . ' ' . $err->getLine())->error();

            return redirect('order/orders');
        }
    }

    public function changeGroup(Request $request)
    {
        $update = Monitor::where('order_id', $request->order_id)
            ->where('li_status', $request->li_status)
            ->update(['group_id' => $request->group_id]);

        flash('Berhasil merubah group')->success();

        return redirect('order/orders');
    }
}
