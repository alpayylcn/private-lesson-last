<?php

namespace App\Services\Backend;

use App\Models\Backend\LessonRequest;
use App\Models\Backend\LessonRequestToTeacher;
use Illuminate\Support\Facades\Auth;

class LessonRequestToTeacherService
{
    public function removeTeacher(int $lessonRequestId, int $teacherId)
    {
       // Pivot tablosunda öğretmeni ders talebinden kaldır
       $deleted = LessonRequestToTeacher::where('lesson_request_id', $lessonRequestId)
       ->where('teacher_id', $teacherId)
       ->delete();

   return $deleted > 0;
    }
}
