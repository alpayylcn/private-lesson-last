<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonRequestToTeacher extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'lesson_request_to_teachers';
    protected $fillable = ['lesson_request_id', 'teacher_id', 'approved'];
}
