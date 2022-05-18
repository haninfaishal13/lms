<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserChangeRole;
use Exception;
use Illuminate\Http\Request;

class ChangeRoleController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {

        try {
            $user_change_role = UserChangeRole::where('id', $request->user_change_role_id);
            $user_change_role->update([
                'status' => $request->status,
            ]);
            $changerole = $user_change_role->first();
            if($request->status == 1) {
                User::where('id', $changerole->user_id)->update([
                    'role' => $changerole->role_request,
                ]);
                return response()->json([
                    'title' => 'Sukses',
                    'message' => 'Berhasil terima permintaan, status user telah diubah',
                    'type' => 'success',
                ]);
            }
            else {
                return response()->json([
                    'title' => 'Sukses',
                    'message' => 'Berhasil terima permintaan, status user tidak diubah',
                    'type' => 'success',
                ]);
            }
        }
        catch(Exception $e) {
            return response()->json([
                'title' => 'Error',
                'message' => 'Gagal terima permintaan',
                'type' => 'error',
                'exception' => $e,
            ]);
        }
    }

    public function destroy($id)
    {

    }

    public static function changerequest_role($role)
    {
        $changerole = UserChangeRole::with('user')->where([
            'role_request' => $role,
            'status' => 0,
        ])->orderBy('created_at', 'desc')->get();

        return $changerole;
    }
}
