<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherAppointmentList extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'teacher_appointment_lists';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'teacher_id',
        'student_id',
        'unregistered_student_id',
        'lesson_id',
        'class',
        'note'
    ];
        public function user(){
            return $this->hasOne(User::class,'id','student_id'); 
        }
        public function unregistered_student(){
            return $this->hasOne(UnregisteredStudent::class,'id','unregistered_student_id'); 
        }
        public function lesson()
        {
            return $this->hasOne(Lesson::class,'id','lesson_id');
        }
}
