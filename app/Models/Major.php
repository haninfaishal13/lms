<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;
    protected $table = 'majors';
    protected $guarded = [];

    public function user_study()
    {
        return $this->hasMany(UserStudy::class, 'user_study_id', 'id');
    }

    public function lesson()
    {
        return $this->hasMany(Lesson::class, 'user_study_id', 'id');
    }
}
