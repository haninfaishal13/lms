<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserTeach;
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

    public function index_assign_guru($username)
    {
        $data['user'] = User::with('user_teach')->where('username', $username)->first();
        // $data['user_teach'] = $data['user']->user_teach
    }
    
    public function assign_guru(Request $request)
    {
        $user_id = $request->user_id;
        $lesson_id = $request->lesson_grade_major_id;
        try {
            UserTeach::create([
                'user_id' => $user_id,
                'lesson_id' => $lesson_id,
                'start_date' => date('Y-m-d H:i:s'),
            ]);

            return response()->json([
                'title' => 'Sukses',
                'message' => 'Berhasil menempatkan Guru',
                'type' => 'success'
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'title' => 'Gagal',
                'message' => 'Gagal menempatkan Guru',
                'type' => 'error'
            ]);
        }
    }

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
}
