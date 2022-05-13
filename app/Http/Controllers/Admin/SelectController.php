<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnnCategory;
use App\Models\Grade;
use App\Models\GradeCluster;
use App\Models\Lesson;
use App\Models\Major;
use App\Models\User;
use Illuminate\Http\Request;

class SelectController extends Controller
{

    public function selUserStudent(Request $request)
    {
        $search = $request->search;

        if($search == '') {
            $grade = User::select('id', 'name')->where('role', 'student')->limit(20)->get();
        }
        else {
            $grade = User::select('id', 'name')->where('role', 'student')->where('name', 'like', '%'.$search.'%')->limit(20)->get();
        }

        $response = array();
        foreach($grade as $grade) {
            $response[] = array(
                "id" => $grade->id,
                "text" => $grade->name,
            );
        }
        return json_encode($response);
    }

    public function selUserTeacher(Request $request)
    {
        $search = $request->search;

        if($search == '') {
            $grade = User::select('id', 'name')->where('role', 'teacher')->limit(20)->get();
        }
        else {
            $grade = User::select('id', 'name')->where('role', 'teacher')->where('name', 'like', '%'.$search.'%')->limit(20)->get();
        }

        $response = array();
        foreach($grade as $grade) {
            $response[] = array(
                "id" => $grade->id,
                "text" => $grade->name,
            );
        }
        return json_encode($response);
    }

    public function selGrade(Request $request)
    {
        $search = $request->search;

        if($search == '') {
            $grade = Grade::select('id', 'name')->limit(20)->get();
        }
        else {
            $grade = Grade::select('id', 'name')->where('name', 'like', '%'.$search.'%')->limit(20)->get();
        }

        $response = array();
        foreach($grade as $grade) {
            $response[] = array(
                "id" => $grade->id,
                "text" => $grade->name,
            );
        }
        return json_encode($response);
    }

    public function selGradeCluster(Request $request)
    {
        $search = $request->search;

        if($search == '') {
            $grade = GradeCluster::select('id', 'name')->where('grade_id', $request->grade_id)->limit(20)->get();
        }
        else {
            $grade = GradeCluster::select('id', 'name')->where('grade_id', $request->grade_id)->where('name', 'like', '%'.$search.'%')->limit(20)->get();
        }

        $response = array();
        foreach($grade as $grade) {
            $response[] = array(
                "id" => $grade->id,
                "text" => $grade->name,
            );
        }
        return json_encode($response);
    }

    public function selLesson(Request $request)
    {
        $search = $request->search;

        if($search == '') {
            $lesson = Lesson::select('id', 'name')->limit(20)->get();
        }
        else {
            $lesson = Lesson::select('id', 'name')->where('name', 'like', '%'.$search.'%')->limit(20)->get();
        }

        $response = array();
        foreach($lesson as $lesson) {
            $response[] = array(
                "id" => $lesson->id,
                "text" => $lesson->name,
            );
        }
        return json_encode($response);
    }

    public function selMajor(Request $request)
    {
        $search = $request->search;

        if($search == '') {
            $major = Major::select('id', 'name')->limit(20)->get();
        }
        else {
            $major = Major::select('id', 'name')->where('name', 'like', '%'.$search.'%')->limit(20)->get();
        }

        $response = array();
        foreach($major as $major) {
            $response[] = array(
                "id" => $major->id,
                "text" => $major->name,
            );
        }
        return json_encode($response);
    }

    public function selAnnCategory(Request $request)
    {
        $search = $request->search;

        if($search == '') {
            $ann_category = AnnCategory::select('id', 'name')->limit(20)->get();
        }
        else {
            $ann_category = AnnCategory::select('id', 'name')->where('name', 'like', '%'.$search.'%')->limit(20)->get();
        }

        $response = array();
        foreach($ann_category as $category) {
            $response[] = array(
                "id" => $category->id,
                "text" => $category->name,
            );
        }
        return json_encode($response);
    }
}
