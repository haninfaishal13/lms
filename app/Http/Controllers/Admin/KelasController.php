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
    public function index()
    {
        return view('admin.kelas.daftar');
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
            GradeCluster::create([
                'grade_id' => $request->grade_id,
                'name' => $request->name,
                'description' => $request->description,
                'status' => '1',
            ]);
            return response()->json([
                'type' => 'success',
                'title' => 'Sukses !',
                'message' => 'Berhasil menambahkan kelas'
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'type' => 'error',
                'title' => 'Error !',
                'message' => 'Terjadi kesalahan, silakan coba lagi atau hubungi administrator',
                'exception' => $e,
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $grade = GradeCluster::find($id);
        return response()->json($grade);
    }

    public function update(Request $request, $id)
    {
        try{
            $kelas = GradeCluster::findOrFail($id);
            $kelas->update([
                'grade_id' => $request->grade_id,
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return response()->json([
                'type' => 'success',
                'title' => 'Sukses',
                'message' => 'Berhasil mengubah data kelas'
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Gagal mengubah data kelas',
                'exception' => $e,
            ]);
        }

    }

    public function destroy($id)
    {
        try{
            GradeCluster::where('id', $id)->delete();

            return response()->json([
                'title' => 'Sukses',
                'message' => 'Berhasil menghapus kelas',
                'type' => 'success',
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'title' => 'Error',
                'message' => 'Gagal menghapus kelas',
                'type' => 'error',
                'exception' => $e,
            ]);
        }

    }

    // <====================== Permintaan Kelas ============================>
    public function permintaan_kelas()
    {
        return view('admin.kelas.permintaan');
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

    // <====================== Tingkat ===========================>
    public function index_tingkat()
    {
        return view('admin.kelas.daftar-tingkat');
    }

    public function store_tingkat(Request $request)
    {
        try {
            Grade::create([
                'name' => $request->name,
                'status' => 1,
            ]);

            return response()->json([
                'title' => 'Sukses',
                'message' => 'Berhasil menambahkan tingkat',
                'type' => 'success'
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'title' => 'Error',
                'message' => 'Gagal menambahkan tingkat',
                'type' => 'error',
                'exception' => $e,
            ]);
        }
    }

    public function edit_tingkat($id)
    {
        $grade = Grade::find($id);
        return response()->json($grade);
    }

    public function update_tingkat(Request $request, $id)
    {
        try {
            Grade::where('id', $id)->update([
                'name' => $request->name,
            ]);

            return response()->json([
                'title' => 'Sukses',
                'message' => 'Berhasil mengupdate tingkat',
                'type' => 'success'
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'title' => 'Error',
                'message' => 'Gagal mengupdate tingkat',
                'type' => 'error',
                'exception' => $e,
            ]);
        }
    }

    public function destroy_tingkat($id)
    {
        try{
            Grade::where('id', $id)->delete();
            return response()->json([
                'title' => 'Sukses',
                'message' => 'Berhasil menghapus tingkat',
                'type' => 'success'
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'title' => 'Error',
                'message' => 'Gagal menghapus tingkat',
                'type' => 'error',
                'exception' => $e,
            ]);
        }

    }

    // <====================== Datatable =============================>
    public function dt_grade_index()
    {
        $model = Grade::where('status', '1')->get();
        $dTable = DataTables()->of($model)->addIndexColumn()
            ->editColumn('name', function($data) {
                return $data->name;
            })
            ->addColumn('action', function($data) {
                $btn = '';
                $btn .= '
                    <button class="btn btn-primary btn-sm" onclick="edittingkat('.$data->id.')"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deletetingkat('.$data->id.')">Delete</button>
                ';
                return $btn;
            })
            ->rawColumns(['action'])
            ;

        return $dTable->make(true);
    }
    public function dt_index()
    {
        $model = GradeCluster::with('grade')->where('status', '1')->get();
        $dTable = DataTables()->of($model)->addIndexColumn()
            ->editColumn('name', function($data) {
                return $data->grade->name.'-'.$data->name;
            })
            ->addColumn('action', function($data) {
                $btn = '';
                $btn .= '
                    <button class="btn btn-primary btn-sm" onclick="editkelas('.$data->id.')" title="Edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deletekelas('.$data->id.')" title="Delete">Delete</button>
                ';
                return $btn;
            })
            ->rawColumns(['action']);

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

    // <==================== Select2 =======================>

}
