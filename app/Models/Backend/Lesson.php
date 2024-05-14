<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory,SoftDeletes;
    public $timestamps = true;
    protected $table = 'lessons';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'title',
        'add_user_id'];

        public function add_user() :HasOne 
        {
            return $this->hasOne(User::class,'id','add_user_id');
        } 

        public function lesson_to_classes():HasMany{
            return $this->hasMany(LessonToClass::class,'lesson_id','id');
        }
        public function teacher_to_lessons():HasMany{
            return $this->hasMany(TeacherToLessonAndClass::class,'lesson_id','id');
        } 
        public function hasLesson()//x dersi TeacherToLessonAndClass tablosunda var mı?
        {
            return $this->teacher_to_lessons()->exists();
        }
        public function teacher_to_lesson_price():HasMany{
            return $this->hasMany(TeacherToLessonPrice::class,'lesson_id','id');
        }
        public function hasLessonPrice()//x dersi TeacherToLessonPrice tablosunda var mı?
        {
            return $this->teacher_to_lesson_price()->exists();
        }
        
}
