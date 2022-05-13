<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTeachLesson extends Model
{
    use HasFactory;

    protected $table = "user_teach_lessons";
    protected $guarded = [];

    public function user_teach()
    {
        return $this->belongsTo(UserTeach::class, 'user_teach_id', 'id');
    }

    public function lesson_grade_major()
    {
        return $this->belongsTo(LessonGradeMajor::class, 'lesson_grade_major_id', 'id');
    }
}
