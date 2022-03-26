<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_daftar()
    {
        return view('admin.guru.daftar');
    }

    public function index_permintaan()
    {
        return view('admin.guru.permintaan');
    }

    public function dt_daftar()
    {
        $model = User::where('role', 'teacher')->get();
        $dTable = DataTables()->of($model)->addIndexColumn()
            ->editColumn('name', function($data) {
                return $data->name;
            })
            ->editColumn('description', function($data){
                return $data->description;
            })
            ->editColumn('level', function($data) {
                return $data->level->level;
            })
            ->addColumn('action', function($data) {
                $btn = '';
                $btn .= '
                    <button class="btn btn-primary btn-sm" onclick="editkelas('.$data->id.')"></i>Edit</button>
                    <button class="btn btn-danger btn-sm">Delete</button>
                ';
                return $btn;
            })
            ->rawColumns(['action'])
            ;

        return $dTable->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
