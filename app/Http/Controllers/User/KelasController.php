<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        if($role != 'student') {
            return redirect('user.index');
        }

        $user_study = GeneralController::index_student();
        $grade_cluster = $user_study->grade_cluster;
        $major = $user_study->major;
        $lessons = GeneralController::index_lesson_grade_major($grade_cluster->grade->id, $major->id);

        return view('user.kelas.index', compact('grade_cluster', 'user_study', 'major', 'lessons'));
    }
}
