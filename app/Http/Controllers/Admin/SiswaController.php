<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserStudy;
use App\Models\UserTeach;
use Exception;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        return view('admin.siswa.daftar');
    }

    public function store(Request $request)
    {
        try {
            UserStudy::create([
                'user_id' => $request->user_id,
                'grade_cluster_id' => $request->grade_cluster_id,
                'major_id' => $request->major_id,
                'status' => 1,
                'start_date' => date('Y-m-d H:i:s'),
            ]);
            return response()->json([
                'title' => 'sukses',
                'message' => 'Berhasil menambahakan siswa',
                'type' => 'success'
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'title' => 'Error',
                'message' => 'Gagal menambahkan siswa',
                'type' => 'error',
                'exception' => $e,
            ]);
        }
    }

    public function show($id)
    {
        $student = UserStudy::with('user')->find($id);
        return view('admin.siswa.detail', compact('student'));
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        try {
            UserStudy::where('id', $id)->delete();

            return response()->json([
                'title' => 'Sukses',
                'message' => 'Berhasil menghapus siswa',
                'type' => 'success',
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'title' => 'Error',
                'message' => 'Gagal menghapus siswa',
                'type' => 'error',
                'exception' => $e,
            ]);
        }
    }



    // <==================== Permintaan ==================>
    public function index_permintaan()
    {
        return view('admin.siswa.permintaan');
    }

    // <===================== datatable ===========================>
    public function dt_daftar_all()
    {
        $model = User::where('role', 'student')->get();
        $dTable = DataTables()->of($model)->addIndexColumn()
            ->editColumn('name', function($data) {
                return $data->user->name;
            })
            ->editColumn('grade_cluster', function($data) {
                return $data->grade_cluster->grade->name.' - '.$data->grade_cluster->name;
            })
            ->editColumn('major', function($data) {
                return $data->major->name;
            })
            ->editColumn('address', function($data) {
                if($data->user->address ) {
                    return $data->user->address;
                }
                else {
                    return '-';
                }
            })
            ->editColumn('start_date', function($data) {
                return $data->start_date;
            })
            ->editColumn('end_date', function($data) {
                if($data->end_date == null) {
                    return '-';
                }
                else {
                    return $data->end_date;
                }
            })
            ->addColumn('action', function($data) {
                $btn = '';
                $btn .= '
                    <a class="btn btn-primary btn-sm" href="'.route("admin.guru.detail.show", $data->id).'" title="Detail"><i class="fas fa-book"></i></a>
                    <button class="btn btn-primary btn-sm" onclick="editsiswa('.$data->id.')" title="Edit"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['action'])
            ;

        return $dTable->make(true);
    }

    public function dt_daftar_aktif()
    {
        $model = UserStudy::with([
            'major', 'user',
            'grade_cluster' => function($q) {
                $q->with('grade');
            },
        ])->where('status', '1')->get();
        $dTable = DataTables()->of($model)->addIndexColumn()
            ->editColumn('name', function($data) {
                return $data->user->name;
            })
            ->editColumn('grade_cluster', function($data) {
                return $data->grade_cluster->grade->name.' - '.$data->grade_cluster->name;
            })
            ->editColumn('major', function($data) {
                return $data->major->name;
            })
            ->editColumn('address', function($data) {
                if($data->user->address ) {
                    return $data->user->address;
                }
                else {
                    return '-';
                }
            })
            ->editColumn('start_date', function($data){
                return $data->start_date;
            })
            ->editColumn('end_date', function($data){
                if($data->end_date == null) {
                    return '-';
                }
                else {
                    return $data->end_date;
                }
            })
            ->addColumn('action', function($data) {
                $btn = '';
                $btn .= '
                    <a class="btn btn-primary btn-sm" href="'.route("admin.siswa.detail.show", $data->id).'" title="Detail"><i class="fas fa-book"></i></a>
                    <button class="btn btn-primary btn-sm" onclick="editsiswa('.$data->id.')" title="Edit"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['action'])
            ;

        return $dTable->make(true);
    }

    public function dt_daftar_nonatkif()
    {
        $model = UserStudy::where('status', '1')->get();
        $dTable = DataTables()->of($model)->addIndexColumn()
            ->editColumn('name', function($data) {
                return $data->user->name;
            })
            ->editColumn('start_time', function($data){
                return $data->start_time;
            })
            ->editColumn('end_time', function($data){
                return $data->end_time;
            })
            ->editColumn('address', function($data) {
                if($data->user->address ) {
                    return $data->user->address;
                }
                else {
                    return '-';
                }
            })
            ->addColumn('action', function($data) {
                $btn = '';
                $btn .= '
                    <button class="btn btn-primary btn-sm"><i class="fas fa-book"></i></button>
                    <button class="btn btn-primary btn-sm" onclick="editsiswa('.$data->id.')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['action'])
            ;

        return $dTable->make(true);
    }
}
