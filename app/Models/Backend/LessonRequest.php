<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonRequest extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'student_id', 'lesson_id', 'status','session_id','request_duration'
    ];

    public function student()
    {
        return $this->belongsTo(User::class,'student_id', 'id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class,'lesson_id','id');
    }
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by','id');
    }
}
