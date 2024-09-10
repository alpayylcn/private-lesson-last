<?php

namespace App\Http\Controllers;

use App\Models\Backend\CreditSetting;
use App\Models\Backend\Duration;
use App\Models\Backend\Reason;
use App\Models\Backend\TeacherAdvertisement;
use App\Models\Backend\Wallet;
use App\Models\User;
use App\Services\Backend\CreditService;
use App\Services\Backend\StudentPrivateLessonSearchService;
use App\Services\Backend\TeacherCardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherCardController extends Controller
{
    public function __construct(
        
        protected CreditService $creditService,
        protected TeacherCardService $teacherCardService,
        protected StudentPrivateLessonSearchService $studentPrivateLessonSearchService,
    
    ){}   
    
    public function index()
    {
        // Öğretmenleri ve onaylı ilanlarını servisten alın
        $teachers = $this->teacherCardService->getTeachersWithFirstApprovedAdvertisement();

        return view('teacher_cards.index', compact('teachers'));
    }
    public function chooseTheTeacher()
    {   
        $studentId=Auth::user()->id;
        // Öğrencinin filtreleme kriterlerine göre öğretmenleri al
        $teachers = $this->teacherCardService->searchTeachersByStudentCriteria($studentId);
        $lesson_id= $this->studentPrivateLessonSearchService->studentChooseLesson($studentId);
        $class_id= $this->studentPrivateLessonSearchService->studentChooseClass($studentId);

        return view('filter_lesson.filter_teacher_list', compact('teachers','lesson_id','class_id'));
    }
}
