<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        $role = Auth::user()->role;
        $announcements = GeneralController::index_announcement();

        if($role == "public") {
            return view('user.index', compact('title', 'announcements', 'role'));
        }
        elseif($role == "student") {
            $user_study = GeneralController::index_student();
            if($user_study == null) {
                $lessons = "";
                $grade = "";
                $major = "";
            }
            else {
                $grade_cluster = $user_study->grade_cluster;
                $major = $user_study->major;
                $lessons = GeneralController::index_lesson_grade_major($grade_cluster->grade->id, $major->id);
            }

            return view('user.index', compact('announcements', 'user_study', 'grade_cluster', 'lessons', 'role'));
        }
        elseif($role == "teacher") {
            $user_teach = GeneralController::index_teach();
            if($user_teach == null) {
                $user_teach_lessons = "";
            }
            else {
                $user_teach_lessons = $user_teach->user_teach_lesson;
            }
            return view('user.index', compact('announcements', 'user_teach', 'user_teach_lessons', 'role'));
        }
    }
}
