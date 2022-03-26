<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';
    protected $guarded = [];

    public function grade_user()
    {
        return $this->hasMany(UserGrade::class, 'grade_id', 'id');
    }

    public function level() 
    {
        return $this->belongsTo(GradeLevel::class, 'grade_level_id', 'id');
    }
}
