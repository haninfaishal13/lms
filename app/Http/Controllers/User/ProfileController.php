<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index()
    {

    }

    public function show($username)
    {
        $user = Auth::user();
        $title = $user->name;
        $role = $user->role;
        if($user->photo_profile != null) {
            $photo_profile = File::exists(public_path('storage/'.$user->photo_profile)) ? 'storage/'.$user->photo_profile : 'img/profile/img1.jpg';
        }
        else {
            $photo_profile = 'img/profile/img1.jpg';
        }
        if(Auth::user()->gender == 2) {
            $gender = "Laki-laki";
        }
        elseif($user->gender == 1) {
            $gender = "Perempuan";
        }
        else {
            $gender = "-";
        }
        $type_page = $username == Auth::user()->username ? 'own' : 'other';

        if($role == "public") {
            $status_request = $user->change_role->reverse()->first();
            return view('user.profil.index', compact('user', 'title', 'photo_profile', 'gender', 'status_request', 'type_page', 'role'));
        }
        else {
            return view('user.profil.index', compact('user', 'title', 'photo_profile', 'gender', 'type_page', 'role'));
        }
    }
}
