<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Status\WorksheetStatus;
use App\Models\Worksheet\Worksheet;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \Auth::user();

        if($user->hasRole('agent')) {
            $status = WorksheetStatus::get();

            $data = [];

            foreach ($status as $key => $value) {
                $count = Worksheet::where('work_status', $value->name)
                    ->where('work_agen', $user->agen_id)
                    ->count();

                $total_order = Worksheet::where('work_agen', $user->agen_id)->count();

                if($count) {
                    $total = $count;
                } else {
                    $total = 0;
                }

                if($total == 0) {
                    $percent = 0;
                } else {
                    $percent = ($total / $total_order) * 100;
                }

                $value = [
                    'status' => $value->display_name,
                    'total' => $total,
                    'percent' => $percent
                ];

                array_push($data, (object) $value);
            }

            $data = (object) $data;

            $symp = \DB::table('symp_status')->get();

            $data2 = [];

            foreach ($symp as $key => $value) {
                $count = Worksheet::where('work_symptomp', $value->symp_id)
                    ->where('work_agen', $user->agen_id)
                    ->count();

                if($count) {
                    $total = $count;
                } else {
                    $total = 0;
                }

                $value = [
                    'name' => $value->symp_name,
                    'total' => $total
                ];

                array_push($data2, (object) $value);
            }

            $data2 = (object) $data2;

            $total_all = Worksheet::where('work_agen', $user->agen_id)->count();

            $working_total = Worksheet::where('work_agen', $user->agen_id)->whereNotNull('work_status')->count();

            $blank = $total_all - $working_total;
            
            if($blank == 0) {
                $percent_blank = 0;
            } else {
                $percent_blank = ($blank / $total_all) * 100;
            }

            return view('homes.agen.index', compact('data', 'data2', 'total_all', 'working_total', 'percent_blank'));
        } else {
            return view('homes.admin.index');
        }
    }
}
