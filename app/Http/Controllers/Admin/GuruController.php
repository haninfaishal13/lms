<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\LessonGradeMajor;
use App\Models\Major;
use App\Models\User;
use App\Models\UserTeach;
use App\Models\UserTeachLesson;
use Exception;
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

    public function daftarkan_guru_create()
    {
        return view('admin.guru.tambah');
    }

    public function daftarkan_guru(Request $request)
    {
        try {
            UserTeach::create([
                'user_id' => $request->user_id,
                'status' => '1',
                'start_date' => date('Y-m-d H:i:s'),
            ]);
            return response()->json([
                'title' => 'Sukses',
                'message' => 'Berhasil menambahkan guru',
                'type' => 'success',
            ]);
        }
        catch(Exception $e) {
            // return $e;
            return response()->json([
                'title' => 'Error',
                'message' => 'Gagal menambahkan guru',
                'type' => 'error'
            ]);
        }
    }

    public function show($id)
    {
        $teacher = UserTeach::with('user')->find($id);
        $grade = Grade::get();
        $major = Major::get();
        $lesson = Lesson::get();
        return view('admin.guru.detail', compact('teacher', 'grade', 'major', 'lesson'));
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

    // <================== Atur Mapel Guru =====================>
    public function atur_mapel_guru(Request $request, $id)
    {
        // dd($request->all());
        try {
            UserTeachLesson::create([
                'lesson_grade_major_id' => $request->lesson_grade_major_id,
                'user_teach_id' => $id,
                'start_time' => $request->start_date,
            ]);

            return response()->json([
                'title' => 'Sukses',
                'message' => 'Berhasil mengatur mapel guru',
                'type' => 'success',
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'title' => 'Error',
                'message' => 'Gagal mengatur mapel guru',
                'type' => 'error',
                'exception' => $e,
            ]);
        }
    }

    public function edit_mapel_guru($id)
    {
        $mapel_guru = UserTeachLesson::with([
            'lesson_grade_major' => function($q) {
                $q->with('grade', 'major', 'lesson');
            }
        ])->find($id);

        $user_teach_lesson = [
            'id' => $mapel_guru->id,
            'start_date' => $mapel_guru->start_time,
            'end_date' => $mapel_guru->end_time,
        ];

        $lesson_grade_major = [
            'id' => $mapel_guru->lesson_grade_major->id,
            'name' => $mapel_guru->lesson_grade_major->name,
        ];

        $major = [
            'id' => $mapel_guru->lesson_grade_major->major->id,
            'name' => $mapel_guru->lesson_grade_major->major->name,
        ];

        $grade = [
            'id' => $mapel_guru->lesson_grade_major->grade->id,
            'name' => $mapel_guru->lesson_grade_major->grade->name,
        ];

        $lesson = [
            'id' => $mapel_guru->lesson_grade_major->lesson->id,
            'name' => $mapel_guru->lesson_grade_major->lesson->name,
        ];

        return response()->json([
            'user_teach_lesson' => $user_teach_lesson,
            'lesson_grade_major' => $lesson_grade_major,
            'major' => $major,
            'grade' => $grade,
            'lesson' => $lesson,
        ]);
    }

    public function update_mapel_guru(Request $request, $id)
    {
        try{
            UserTeachLesson::where('id', $id)->update([
                'lesson_grade_major_id' => $request->lesson_grade_major_id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);

            return response()->json([
                'title' => 'Sukses',
                'message' => 'Berhasil update mapel guru',
                'type' => 'success',
            ]);
        }

        catch(Exception $e) {
            return response()->json([
                'title' => 'Error',
                'message' =>'Gagal update mapel guru',
                'type' => 'error',
                'exception' => $e,
            ]);
        }
    }

    public function delete_mapel_guru($id) {
        try {
            UserTeachLesson::where('id', $id)->delete();
            return response()->json([
                'title' => 'Sukses',
                'message' => 'Berhasil hapus mata pelajaran',
                'type' => 'success'
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'title' => 'Error',
                'message' => 'gagal hapus mata pelajaran',
                'type' => 'error',
                'exception' => $e,
            ]);
        }
    }

    // <========================= Assign Guru =====================>
    public function update_status_assign_guru(Request $request)
    {
        $userteach_id = $request->id;
        try{
            UserTeach::where('id', $userteach_id)->update([
                'status' => '1',
            ]);
            return response()->json([
                'title' => 'Sukses',
                'message' => 'Berhasil update status penempatan Guru',
                'type' => 'success'
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'title' => 'Gagal',
                'message' => 'Gagal update penempatkan Guru',
                'type' => 'error'
            ]);
        }
    }

    public function delete_assign_guru(Request $request)
    {
        $userteach_id = $request->id;
        try{
            UserTeach::where('id', $userteach_id)->delete();
            return response()->json([
                'title' => 'Sukses',
                'message' => 'Berhasil menempatkan Guru',
                'type' => 'success'
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'type' => 'error',
                'message' => 'Gagal menghapus penempatan guru',
                'title' => 'Gagal'
            ]);
        }
    }

    //    <---------------- Data Table ---------------->

    public function dt_daftar_all()
    {
        $model = User::where('role', 'teacher')->get();
        $dTable = DataTables()->of($model)->addIndexColumn()
            ->editColumn('name', function($data) {
                return $data->name;
            })
            ->editColumn('address', function($data) {
                if($data->address ) {
                    return $data->address;
                }
                else {
                    return '-';
                }
            })
            ->addColumn('action', function($data) {
                $btn = '';
                $btn .= '
                    <button class="btn btn-primary btn-sm" onclick="tambahGuru('.$data->id.')"><i class="fas fa-plus"></i></button>
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['action'])
            ;

        return $dTable->make(true);
    }

    public function dt_daftar_aktif()
    {
        $model = UserTeach::where('status', '1')->get();
        $dTable = DataTables()->of($model)->addIndexColumn()
            ->editColumn('name', function($data) {
                return $data->user->name;
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
            ->addColumn('action', function($data) {
                $btn = '';
                $btn .= '
                    <a class="btn btn-primary btn-sm" href="'.route("admin.guru.detail.show", $data->id).'" title="Detail"><i class="fas fa-book"></i></a>
                    <button class="btn btn-primary btn-sm" onclick="editGuru('.$data->id.')" title="Edit"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['action'])
            ;

        return $dTable->make(true);
    }

    public function dt_daftar_nonaktif()
    {
        $model = UserTeach::where('status', '1')->get();
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
                    <button class="btn btn-primary btn-sm" title="Detail"><i class="fas fa-book"></i></button>
                    <button class="btn btn-primary btn-sm" onclick="editGuru('.$data->id.')" title="Edit"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['action'])
            ;

        return $dTable->make(true);
    }

    public function dt_guru_mapel($id)
    {
        $model = UserTeachLesson::with([
            'user_teach' => function($q) {
                $q->with('user');
            },
            'lesson_grade_major',
        ])->where('user_teach_id', $id)->get();

        $dTable = DataTables()->of($model)->addIndexColumn()
            ->editColumn('lesson', function($data) {
                return $data->lesson_grade_major->name;
            })
            ->editColumn('start_time', function($data){
                return $data->start_time;
            })
            ->editColumn('end_time', function($data){
                if($data->end_time != null) {
                    return $data->end_time;
                }
                else {
                    return "-";
                }
            })
            ->addColumn('action', function($data) {
                $btn = '';
                $btn .= '
                    <button class="btn btn-primary btn-sm" onclick="editmapelguru('.$data->id.')"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deletemapelguru('.$data->id.')">Delete</button>
                ';
                return $btn;
            })
            ->rawColumns(['action'])
            ;

        return $dTable->make(true);
    }

    // Select2
}
