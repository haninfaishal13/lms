<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeLevel extends Model
{
    use HasFactory;

    protected $table = 'grade_levels';
    protected $guarded = [];

    public function grade()
    {
        return $this->hasMany(Grade::class, 'grade_level_id', 'id');
    }
}
