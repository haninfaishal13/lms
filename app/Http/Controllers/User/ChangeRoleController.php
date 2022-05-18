<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserChangeRole;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChangeRoleController extends Controller
{
    public function edit($username)
    {
        $title = "Ubah Status";
        return view('user.daftar_role', compact('username', 'title'));
    }

    public function change_role(Request $request, $username)
    {
        $validator = Validator::make($request->except('_token'), [
            'role' => 'required',
        ]);
        if($validator->fails()) {
            return back()->with('error_changerole', $validator->messages()->first());
        }

        try {
            $user = User::where('username', $username)->first();
            UserChangeRole::create([
                'user_id' => $user->id,
                'role_previous' => $user->role,
                'role_request' => $request->role,
            ]);
            return redirect()->route('user.profile.show', $username)->with('success_changerole', 'Permintaan telah dikirim');
        }
        catch(Exception $e) {
            return $e;
            return back()->with('error_changerole', 'Gagal mengirim permintaan');
        }
    }
}
