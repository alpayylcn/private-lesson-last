<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TeacherAppointmentList extends Model
{
    use HasFactory;
    protected $table = 'teacher_appointment_lists';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'teacher_id',
        'student_id',
        'unregistered_student_id'
    ];
        public function user(){
            return $this->hasOne(User::class,'id','student_id'); 
        }
   
}
