<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $table = 'announcements';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ann_category()
    {
        return $this->belongsTo(AnnCategory::class, 'ann_category_id', 'id');
    }

    public function media()
    {
        return $this->hasMany(AnnMedia::class, 'announcement_id', 'id');
    }

}
