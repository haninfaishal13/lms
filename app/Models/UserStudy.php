<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStudy extends Model
{
    use HasFactory;

    protected $table = 'user_studies';
    protected $guarded = [];

    public function grade_cluster()
    {
        return $this->belongsTo(GradeCluster::class, 'grade_cluster_id', 'id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function user_study_lesson()
    {
        return $this->hasMany(UserStudyLesson::class, 'user_study_id', 'id');
    }
}
