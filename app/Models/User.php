<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Backend\Lesson;
use App\Models\Backend\LessonRequest;
use App\Models\Backend\TeacherToLessonAndClass;
use App\Models\Backend\Wallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'status',
        'approved',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function userDetails():HasOne{
        return $this->hasOne(UserDetail::class,'user_id','id');
    }
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'teacher_to_lesson_and_classes', 'user_id', 'lesson_id');
    }
   
    public function teacherLessons()
    {
        return $this->hasMany(TeacherToLessonAndClass::class, 'user_id');
    }

    public function hasActiveAdvertisement()
    {
        return $this->userDetails && $this->userDetails->has_advertisement;
    }
}
