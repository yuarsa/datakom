<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class MonitoringController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('monitoring');
    }

    public function datatables(Request $request)
    {
        if($request->ajax()) {
            $select = DB::table('monitoring')->select('*')->get();

            $data = Datatables::of($select)
                ->addColumn('action', function($select) {
                    $action = '';

                    return $action;
                })
                ->rawColumns(['action']);

            return $data->make(true);
        } else {
            return abort('404', 'Upps');
        }
    }
}
