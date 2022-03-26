<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index_register() 
    {
        return view('auth.register');
    }
    public function login_process(Request $request)
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $credential = $request->only('username', 'password');
        if(Auth::attempt($credential)) {
            $user = Auth::user();
            if($user->role == 'admin') {
                return redirect()->intended('admin/dashboard');
            }
            elseif($user->role == 'teacher') {
                return redirect()->intended('teacher/dashboard');
            }
            elseif($user->role == 'student') {
                return redirect()->intended('student/dashboard');
            }
            elseif($user->role == 'public') {
                return redirect()->intended('home');
            }
            return redirect()->intended('/');
        }
        return redirect('/');
    }

    public function logout(Request $request) 
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
