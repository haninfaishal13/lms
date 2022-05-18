<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'photo_profile',
        'religion',
        'address',
        'gender',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_study()
    {
        return $this->hasMany(UserStudy::class, 'user_id', 'id');
    }

    public function user_teacher()
    {
        return $this->hasMany(UserTeach::class, 'user_id', 'id');
    }

    public function change_role()
    {
        return $this->hasMany(UserChangeRole::class, 'user_id', 'id');
    }
}
