<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTeach extends Model
{
    use HasFactory;

    protected $table = 'user_teaches';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function user_teach_lesson()
    {
        return $this->hasMany(UserTeachLesson::class, 'user_teach_id', 'id');
    }
}
