<?php

namespace App\Http\Controllers\Worksheets;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agent\AgentGroup;
use App\Models\Monitor\Monitor;
use App\Models\Worksheet\SympStatus;
use App\Models\Status\WorksheetStatus;
use App\Models\Worksheet\Worksheet;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;
use DB;

class WorksheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('worksheets.index');
    }

    public function datatables(Request $request)
    {
        if($request->ajax()) {
            $select = Worksheet::get();

            $data = Datatables::of($select)
                ->addColumn('action', function($select) {
                    $action = '
                        <a href="'.url('worksheet/worksheets/' . $select->work_id . '/edit').'" class="btn btn-sm bg-yellow"><i class="fa fa-pencil"></i></a>
                    ';

                    return $action;
                })
                ->rawColumns(['action']);

            return $data->make(true);
        } else {
            return abort('404', 'Upps');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = \DB::table('monitoring')->pluck('order_id', 'order_id')->toArray();

        $status = WorksheetStatus::pluck('display_name', 'name')->toArray();

        $group_agen = AgentGroup::pluck('grpagen_name', 'grpagen_id')->toArray();

        return view('worksheets.create', compact('status', 'order', 'group_agen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $store = Worksheet::create($request->all());

            flash('Data berhasil ditambahkan')->success();

            return redirect('worksheet/worksheets');
        } catch (QueryException $err) {
            flash($err->getMessage() . ' ' . $err->getLine())->error();

            return redirect('worksheet/worksheets');
        }
    }

    public function tindakan($id)
    {
        $data = Worksheet::find($id);

        $order = Monitor::where('order_id', $data->work_order_id)->where('li_status', $data->work_li_status)->first();
        
        $status = WorksheetStatus::pluck('display_name', 'name')->toArray();

        $symcomp = SympStatus::pluck('symp_name', 'symp_id')->toArray();

        return view('worksheets.edit', compact('data', 'status', 'symcomp', 'order'));
    }

    public function update(Request $request, $id)
    {
        try {
            $update = Worksheet::find($id)->update($request->all());

            flash('Data berhasil dirubah')->success();

            return redirect('order/orders');
        } catch (QueryException $err) {
            flash($err->getMessage() . ' ' . $err->getLine())->error();

            return redirect('order/orders');
        }
    }
}
