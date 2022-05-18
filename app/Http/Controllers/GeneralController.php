<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\LessonGradeMajor;
use App\Models\UserStudy;
use App\Models\UserTeach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    public static function index_student()
    {
        $user_study = UserStudy::with([
            'user',
            'grade_cluster' => function($q) {
                $q->with('grade');
            },
            'major'
        ])->where([
            'user_id' => Auth::id(),
            'status' => 1,
        ])->first();

        return $user_study;
    }

    public static function index_teach()
    {
        $user_teach = UserTeach::with([
            'user_teach_lesson' => function($q) {
                $q->with('lesson_grade_major');
            }
        ])->where([
            'user_id' => Auth::id(),
            'status' => 1,
        ])->first();
        return $user_teach;
    }

    public static function index_announcement()
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->where([
            'status_send' => 1,
            'status_approve' => 1,
        ])->get();
        return $announcements;
    }

    public static function index_lesson_grade_major($grade_id, $major_id)
    {
        $lesson_grade_major = LessonGradeMajor::where([
            'grade_id' => $grade_id,
            'major_id' => $major_id,
        ])->get();
        return $lesson_grade_major;
    }
}
