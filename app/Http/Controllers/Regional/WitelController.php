<?php

namespace App\Http\Controllers\Regional;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Regional\Regional;
use App\Models\Regional\Witel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;

class WitelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('regionals.witel.index');
    }

    public function datatables(Request $request)
    {
        if($request->ajax()) {
            $select = Witel::get();

            $data = Datatables::of($select)
                ->addColumn('regional', function($select) {
                    return $select->regional->reg_display_name;
                })
                ->addColumn('action', function($select) {
                    $action = '
                        <a href="'.url('regional/witels/' . $select->witel_id . '/edit').'" class="btn btn-sm bg-yellow"><i class="fa fa-pencil"></i></a>
                        '.\Form::delete($select->witel_id, 'regional/witels').'
                    ';

                    return $action;
                })
                ->rawColumns(['regional', 'action']);

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
        $regional = Regional::pluck('reg_display_name', 'reg_id')->toArray();

        return view('regionals.witel.create', compact('regional'));
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
            $request['witel_name'] = $request->witel_display_name;
            
            $store = Witel::create($request->all());

            flash('Data berhasil ditambahkan')->success();

            return redirect('regional/witels');
        } catch (QueryException $err) {
            flash($err->getMessage() . ' ' . $err->getLine())->error();

            return redirect('regional/witels');
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
        $data = Witel::findOrFail($id);

        $regional = Regional::pluck('reg_display_name', 'reg_id')->toArray();

        return view('regionals.witel.edit', compact('data', 'regional'));
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
        try {
            $update = Witel::find($id)->update($request->all());

            flash('Data berhasil dirubah')->success();

            return redirect('regional/witels');
        } catch (QueryException $err) {
            flash($err->getMessage() . ' ' . $err->getLine())->error();

            return redirect('regional/witels');
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
        try {
            $delete = Witel::find($id)->delete();

            flash('Data berhasil dihapus')->success();

            return redirect('regional/witels');
        } catch (QueryException $err) {
            flash($err->getMessage() . ' ' . $err->getLine())->error();

            return redirect('regional/witels');
        }
    }
}
