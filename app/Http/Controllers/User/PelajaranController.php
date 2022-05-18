<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Models\LessonGradeMajor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelajaranController extends Controller
{
    public function index()
    {

    }

    public function show($id)
    {
        $role = Auth::user()->role;
        $lesson_detail = LessonGradeMajor::find($id);
        if($role == 'student') {
            $user_study = GeneralController::index_student();
            $grade_cluster = $user_study->grade_cluster;
            $lessons = GeneralController::index_lesson_grade_major($user_study->grade_cluster->grade->id, $user_study->major->id);
            return view('user.pelajaran.index', compact('lesson_detail', 'grade_cluster', 'lessons', 'role'));
        }
        elseif($role == 'teacher') {
            $user_teach = GeneralController::index_teach();
            $lesson_own = 1;
            $user_teach_lessons = $user_teach->user_teach_lesson;
            foreach($user_teach_lessons as $teach_lesson) {
                $lesson_own = 0;
            }
            return view('user.pelajaran.index', compact('lesson_detail', 'lesson_own', 'user_teach_lessons', 'role'));
        }
        elseif($role == 'public') {
            return back();
        }
    }
}
