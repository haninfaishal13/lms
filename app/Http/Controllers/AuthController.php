<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index_register()
    {
        return view('auth.register');
    }
    public function login_process(Request $request)
    {
        $validator = Validator::make($request->except('_token'), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return back()->with('auth_error', $validator->messages()->first());
        }
        $credential = $request->only('username', 'password');
        return $this->authentication_process_v2($credential);
    }


    public function register_process(Request $request)
    {
        $validator = Validator::make($request->except('_token'), [
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'photo_profile' => 'required|mimes:jpg,png,jpeg,JPG,JPEG,PNG|max:20000',
            'religion' => 'required',
            'gender' => 'required'
        ]);

        if($validator->fails()) {
            return back()->with('auth_error', $validator->messages()->first());
        }

        $check = User::where('username', $request->username)->orWhere('email', $request->email)->get();
        if(!$check->isEmpty()) {
            return back()->with('error', 'Email atau username telah digunakan');
        }

        $photo_profile = $request->file('photo_profile')->store(
            'assets/profile/photo_profile', 'public'
        );

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'photo_profile' => $photo_profile,
            'religion' => $request->religion,
            'gender' => $request->gender,
            'address' => $request->address,
            'role' => 'public',
        ]);
        $credential = $request->only('username', 'password');
        return $this->authentication_process_v2($credential);

    }

    public function authentication_process($credential)
    {
        if(Auth::attempt($credential)) {
            $user = Auth::user();
            if($user->role == 'admin') {
                return redirect()->intended('admin/dashboard');
            }
            elseif($user->role == 'teacher') {
                return redirect()->intended('guru/dashboard');
            }
            elseif($user->role == 'student') {
                return redirect()->intended('siswa/dashboard');
            }
            elseif($user->role == 'public') {
                return redirect()->intended('publik/dashboard');
            }
            return redirect()->intended('/');
        }
        return back()->with('auth_error', 'Terjadi kesalahan saat autentikasi');
    }

    public function authentication_process_v2($credential)
    {
        if(Auth::attempt($credential)) {
            $user = Auth::user();
            if($user->role == 'admin') {
                return redirect()->intended('admin/dashboard');
            }
            elseif(in_array($user->role, ['student', 'teacher', 'public'])) {
                return redirect()->intended('dashboard');
            }
            return redirect()->intended('/');
        }
        return back()->with('auth_error', 'Terjadi kesalahan saat autentikasi');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
