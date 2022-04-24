<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeCluster extends Model
{
    use HasFactory;
    
    protected $table = 'grade_clusters';
    protected $guarded = [];

    public function grade() 
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    public function user_study()
    {
        return $this->hasMany(UserStudy::class, 'user_study_id', 'id');
    }
}
