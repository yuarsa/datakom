<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agent\Agent;
use App\Models\Agent\AgentGroup;
use App\Models\Auth\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;
use DB;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('agents.agent.index');
    }

    public function datatables(Request $request)
    {
        if($request->ajax()) {
            $select = Agent::get();

            $data = Datatables::of($select)
                ->addColumn('kelompok', function($select) {
                    return $select->kelompok->grpagen_name;
                })
                ->addColumn('action', function($select) {
                    $action = '
                        <a href="'.url('agent/agents/' . $select->agen_id . '/edit').'" class="btn btn-sm bg-yellow"><i class="fa fa-pencil"></i></a>
                        '.\Form::delete($select->agen_id, 'agent/agents').'
                    ';

                    return $action;
                })
                ->rawColumns(['kelompok', 'action']);

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
        $kelompok = AgentGroup::pluck('grpagen_name', 'grpagen_id')->toArray();

        return view('agents.agent.create', compact('kelompok'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $store = Agent::create($request->except('username', 'password'));

            if($store) {
                $user = new User();

                $user->name = $request->agen_name;
                $user->username = $request->username;
                $user->email = $request->agen_email;
                $user->password = bcrypt($request->password);
                $user->agen_id = $store->agen_id;

                $user->save();

                $user->roles()->attach(['6']);
            }

            DB::commit();

            flash('Data berhasil ditambahkan')->success();

            return redirect('agent/agents');
        } catch (QueryException $err) {
            DB::rollback();

            flash($err->getMessage() . ' ' . $err->getLine())->error();

            return redirect('agent/agents');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Agent::findOrFail($id);

        $kelompok = AgentGroup::pluck('grpagen_name', 'grpagen_id')->toArray();

        return view('agents.agent.edit', compact('data', 'kelompok'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $store = Agent::find($id)->update($request->all());

            if($store) {
                $user = User::where('agen_id', $id)->first();

                $user->name = $request->agen_name;
                $user->email = $request->agen_email;

                $user->update();

                $user->roles()->sync(['6']);
            }

            DB::commit();

            flash('Data berhasil dirubah')->success();

            return redirect('agent/agents');
        } catch (QueryException $err) {
            DB::rollback();

            flash($err->getMessage() . ' ' . $err->getLine())->error();

            return redirect('agent/agents');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $delete = Agent::find($id)->delete();

            if($delete) {
                $user = User::where('agen_id', $id)->delete();
            }

            DB::commit();

            flash('Data berhasil dihapus')->success();

            return redirect('agent/agents');
        } catch (QueryException $err) {
            DB::rollback();

            flash($err->getMessage() . ' ' . $err->getLine())->error();

            return redirect('agent/agents');
        }
    }
}
