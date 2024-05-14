<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherProfile extends Model
{
    use HasFactory,SoftDeletes;
    public $timestamps = true;
    protected $table = 'teacher_profiles';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];

    protected $fillable = [
        'user_id',
        'teacher_short_info',
        'teacher_about',
        'teacher_facility',
        'teacher_why_lesson',
        'teacher_experience',
        'teacher_bring',
        'teacher_about_me',
        'teacher_lesson_process',
        'teacher_advices',
        'teacher_video_link',
        'video_check',
        'teacher_university',
        'teacher_experience_year',
        'university_check'
       
    ];

    public function user() :HasOne
    {
        return $this->hasOne(Lesson::class,'id','user_id');
    } 
   

}
