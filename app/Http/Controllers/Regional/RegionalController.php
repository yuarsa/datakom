<?php

namespace App\Http\Controllers\Regional;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Regional\Regional;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;

class RegionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('regionals.regional.index');
    }

    public function datatables(Request $request)
    {
        if($request->ajax()) {
            $select = Regional::get();

            $data = Datatables::of($select)
                ->addColumn('action', function($select) {
                    $action = '
                        <a href="'.url('regional/regionals/' . $select->reg_id . '/edit').'" class="btn btn-sm bg-yellow"><i class="fa fa-pencil"></i></a>
                        '.\Form::delete($select->reg_id, 'regional/regionals').'
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
        return view('regionals.regional.create');
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
            $request['reg_name'] = $request->reg_display_name;
            
            $store = Regional::create($request->all());

            flash('Data berhasil ditambahkan')->success();

            return redirect('regional/regionals');
        } catch (QueryException $err) {
            flash($err->getMessage() . ' ' . $err->getLine())->error();

            return redirect('regional/regionals');
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
        $data = Regional::findOrFail($id);

        return view('regionals.regional.edit', compact('data'));
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
            $update = Regional::find($id)->update($request->all());

            flash('Data berhasil dirubah')->success();

            return redirect('regional/regionals');
        } catch (QueryException $err) {
            flash($err->getMessage() . ' ' . $err->getLine())->error();

            return redirect('regional/regionals');
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
            $delete = Regional::find($id)->delete();

            flash('Data berhasil dihapus')->success();

            return redirect('regional/regionals');
        } catch (QueryException $err) {
            flash($err->getMessage() . ' ' . $err->getLine())->error();

            return redirect('regional/regionals');
        }
    }
}
