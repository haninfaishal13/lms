<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonGradeMajor extends Model
{
    use HasFactory;

    protected $table = 'lesson_grade_majors';
    protected $guarded = [];

    public function grade() 
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }
}
