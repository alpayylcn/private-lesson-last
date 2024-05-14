<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherToLessonPrice extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'teacher_to_lesson_prices';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];

    protected $fillable=[
        'user_id',
        'lesson_id',
        'lesson_minute',
        'lesson_face_price',
        'lesson_online_price',
        'visible'
       
    ];

    public function user() :HasOne
    {
        return $this->hasOne(Lesson::class,'id','user_id');
    } 

    public function lesson() :HasOne
    {
        return $this->hasOne(Lesson::class,'id','lesson_id');
    } 
}
