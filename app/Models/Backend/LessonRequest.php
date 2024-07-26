<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id', 'lesson_id', 'status',
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
