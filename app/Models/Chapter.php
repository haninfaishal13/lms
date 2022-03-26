<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }

    public function media_materi()
    {
        return $this->hasMany(Media::class, 'chapter_id', 'id')->where('status', '0');
    }

    public function media_tugas()
    {
        return $this->hasMany(Media::class, 'chapter_id', 'id')->where('status', '1');
    }
}
