<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherToLessonAndClass extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'teacher_to_lesson_and_classes';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'user_id',
        'lesson_id',     
        'class_id',        
        'teacher_lesson_location_id',        
                  
             
    ];
    public function user() :HasOne
    {
        return $this->hasOne(Lesson::class,'id','user_id');
    } 
    public function lesson() :HasOne
    {
        return $this->hasOne(Lesson::class,'id','lesson_id');
    } 

    public function classes() :HasOne
    {
        return $this->hasOne(Classes::class,'id','class_id');
    } 
   



}

