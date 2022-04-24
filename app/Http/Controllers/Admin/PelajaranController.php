<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\LessonGradeMajor;
use App\Models\Major;
use Exception;
use Illuminate\Http\Request;

class PelajaranController extends Controller
{
    public function dt_index()
    {
        $model  = Lesson::all();
        $dTable = DataTables()->of($model)->addIndexColumn()
            ->editColumn('name', function($data) {
                return $data->name;
            })
            ->editColumn('description', function($data){
                return $data->description;
            })
            ->addColumn('action', function($data) {
                $btn = '';
                $btn .= '
                    <a class="btn btn-primary btn-sm text-white" href="'.route('admin.pelajaran.show', $data->id).'" title="Detail"><i class="fas fa-book"></i></a>
                    <button class="btn btn-warning btn-sm text-white" onclick="editpelajaran('.$data->id.')" title="Edit"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['action']);

        return $dTable->make(true);
    }
    public function index()
    {
        return view('admin.pelajaran.daftar');
    }

    public function show($id) {
        $data['lesson'] = Lesson::find($id);
        $data['grade'] = Grade::all();
        $data['major'] = Major::all();
        return view('admin.pelajaran.detail', $data);
    }

    public function dt_show($id) {
        $model = LessonGradeMajor::with('lesson', 'major', 'grade')->where('lesson_id', $id)->get();
        $dTable = DataTables()->of($model)->addIndexColumn()
            ->editColumn('name', function($data) {
                return $data->name;
            })
            ->editColumn('grade', function($data){
                return $data->grade->name;
            })
            ->editColumn('major', function($data){
                return $data->major->name;
            })
            ->editColumn('description', function($data) {
                if($data->description) {
                    return $data->description;
                }
                else {
                    return '-';
                }
            })
            ->addColumn('action', function($data) {
                $btn = '';
                $btn .= '
                    <button class="btn btn-warning btn-sm text-white" title="Edit"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['action']);

        return $dTable->make(true);
    }

    public function edit($id) 
    {

    }

    public function update(Request $request, $id) 
    {

    }

    public function destroy($id)
    {

    }

    public function store_lesson_grade_major(Request $request)
    {
        try{
            LessonGradeMajor::create([
                'lesson_id' => $request->lesson_id,
                'grade_id' => $request->grade_id,
                'major_id' => $request->major_id,
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return response()->json([
                'title' => 'Berhasil',
                'message' => 'Berhasil tambah pelajaran',
                'type' => 'success'
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'title' => 'Gagal',
                'message' => 'Gagal menambahkan pelajaran',
                'type' => 'error',
            ]);
        }
    }
}
