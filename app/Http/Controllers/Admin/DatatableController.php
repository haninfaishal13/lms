<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class DatatableController extends Controller
{
    public function dt_pengumuman_daftar()
    {
        $model = Announcement::with('ann_category', 'user')->where('status_send', 1)->where('status_approve', 1)->get();
        $dTable = DataTables()->of($model)->addIndexColumn()
            ->editColumn('name', function($data) {
                return $data->user->name;
            })
            ->editColumn('category', function($data) {
                return $data->ann_category->name;
            })
            ->editColumn('title', function($data) {
                return $data->title;
            })
            ->editColumn('header', function($data) {
                return $data->header;
            })
            ->addColumn('action', function($data) {
                $btn = '';
                $btn .= '
                    <button class="btn btn-primary btn-sm" onclick="detailpengumuman('.$data->id.')" title="Detail"><i class="fas fa-book"></i></button>
                    <a href="'.route('admin.pengumuman.edit', $data->id).'" class="btn btn-primary btn-sm"></i><i class="fas fa-edit"></i></a>
                    <button class="btn btn-danger btn-sm" onclick="deletepengumuman('.$data->id.')"><i class="fas fa-trash"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['action']);

        return $dTable->make(true);
    }
}
