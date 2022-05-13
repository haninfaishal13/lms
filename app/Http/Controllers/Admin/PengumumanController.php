<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnnMedia;
use App\Models\Announcement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index_daftar()
    {
        return view('admin.pengumuman.daftar');
    }

    public function create()
    {
        return view('admin.pengumuman.buat');
    }

    public function store(Request $request)
    {
        try {

            if(isset($request->header)) {
                $header_path = $request->file('header')->store(
                    'assets/announcement/header', 'public'
                );
            }
            else {
                $header_path = "";
            }

            $announcement_id = Announcement::create([
                'user_id' => Auth::id(),
                'ann_category_id' => $request->ann_category_id,
                'title' => $request->title,
                'header' => $header_path,
                'text' => $request->text,
                'status_send' => 1,
                'status_approve' => 1,
            ])->id;

            foreach($request->media as $media) {
                $mname = str_replace(' ', '_', $media->getClientOriginalName());
                $media_name = time().'-'.$mname;
                AnnMedia::create([
                    'announcement_id' => $announcement_id,
                    'path' => $media->storeAs(
                        'assets/announcement/media', $media_name, 'public'
                    ),
                ]);
            }
            return response()->json([
                'title' => 'Sukses',
                'message' => 'Berhasil menambah pengumuman',
                'type' => 'success',
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'title' => 'Error',
                'message' => 'Gagal menambah pengumuman',
                'type' => 'error',
                'exception' => $e,
            ]);
        }

    }

    public function show($id)
    {
        $announcement = Announcement::find($id);
        return response()->json($announcement);
    }

    public function edit($id)
    {
        $announcement = Announcement::find($id);
        return view('admin.pengumuman.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        try {
            $announcement = Announcement::with('media')->where('id', $id)->first();
            $ann_media = $announcement->media;

            if(!$ann_media->isEmpty()) {
                foreach($ann_media as $media) {
                    $media_file = Storage::disk('public')->path($media->path);
                    File::delete($media_file);
                    $media->delete();
                }
            }
            
            $header_file = Storage::disk('public')->path($announcement->header);
            File::delete($header_file);
            $announcement->delete();

            return response()->json([
                'title' => 'Sukses',
                'message' => 'Berhasil menghapus data',
                'type' => 'success'
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'title' => 'Error',
                'message' => 'Gagal menghapus data',
                'type' => 'error',
                'exception' => $e,
            ]);
        }
    }

    // <================== Pengajuan Pengumuman =================>
    public function index_pengajuan()
    {
        return view('admin.pengumuman.pengajuan');
    }

    public function update_status(Request $request, $id)
    {

    }
}
