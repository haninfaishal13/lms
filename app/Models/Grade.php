<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';
    protected $guarded = [];

    public function lesson()
    {
        return $this->hasMany(Lesson::class, 'lesson_id', 'id');
    }

    public function grade_cluster()
    {
        return $this->hasMany(GradeCluster::class, 'grade_id', 'id');
    }
}
