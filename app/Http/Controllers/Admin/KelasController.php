<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\GradeCluster;
use Exception;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dt_index()
    {
        $model = GradeCluster::where('status', '1')->get();
        $dTable = DataTables()->of($model)->addIndexColumn()
            ->editColumn('name', function($data) {
                return $data->grade->name.'-'.$data->name;
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

    public function dt_permintaan()
    {
        $model = Grade::where('status', '0')->get();
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
                    <button class="btn btn-primary btn-sm" onclick="terimakelas('.$data->id.')"><i class="fas fa-plus"></i></button>
                    <button class="btn btn-danger btn-sm">Delete</button>
                ';
                return $btn;
            })
            ->rawColumns(['action'])
            ;

        return $dTable->make(true);
    }

    public function index()
    {
        return view('admin.kelas.daftar');
    }

    public function permintaan_kelas()
    {
        return view('admin.kelas.permintaan');
    }
    
    public function grade_level()
    {
        $level = Grade::select('id','name')->get();
        return response()->json($level);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try{
            Grade::create([
                'grade_level_id' => $request->level_kelas,
                'name' => $request->nama_kelas,
                'description' => $request->deskripsi_kelas,
                'status' => '1',
            ]);
            return response()->json([
                'success' => true,
                'type' => 'success',
                'title' => 'Sukses !',
                'message' => 'Berhasil menambahkan kelas'
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'success' => false,
                'type' => 'error',
                'title' => 'Error !',
                'message' => 'Terjadi kesalahan, silakan coba lagi atau hubungi administrator',
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $grade = Grade::find($id);
        return response()->json($grade);
    }

    public function update(Request $request, $id)
    {
        $kelas = Grade::findOrFail($id);
        $kelas->update([
            'grade_level_id' => $request->level_kelas,
            'name' => $request->nama_kelas,
            'description' => $request->deskripsi_kelas,
        ]);
        return response()->json([
            'success' => true,
            'type' => 'success',
            'title' => 'Sukses !',
            'message' => 'Berhasil mengubah data kelas'
        ]);
    }

    public function confirm_kelas($id)
    {
        try{
            $kelas = Grade::find($id);
            $kelas->update([
                'status' => '1'
            ]);
            return response()->json([
                'success' => true,
                'title' => 'Sukses !',
                'type' => 'success',
                'message' => 'Berhasil menerima permintaan kelas'
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'success' => false,
                'title' => 'Gagal !',
                'type' => 'error',
                'message' => 'Terjadi kesalahan, silakan coba lagi nanti'
            ]);
        }
    }
    public function destroy($id)
    {
        //
    }
}
