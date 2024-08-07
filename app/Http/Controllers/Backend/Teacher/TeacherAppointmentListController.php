<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Backend\TeacherAppointmentList;
use App\Http\Requests\StoreTeacherAppointmentListRequest;
use App\Http\Requests\UpdateTeacherAppointmentListRequest;
use App\Models\Backend\Lesson;
use App\Models\Backend\LessonRequest;
use App\Models\Backend\TeacherRequest;
use App\Services\Backend\TeacherAppointmentListService;
use Illuminate\Support\Facades\Auth;

class TeacherAppointmentListController extends Controller
{
    public function __construct(
        protected  TeacherAppointmentListService $teacherAppointmentListService,
        
        ){}
    public function index()
    {
        $appointmentList=$this->teacherAppointmentListService->getWithWhere();
        return view('teachers.appointment_from_student',compact('appointmentList'));
    }
    
    public function fromAdmin()
    {
        $lessonRequests = LessonRequest::with('student')->get();

        return view('teachers.appointment_from_admin', compact('lessonRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherAppointmentListRequest $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(TeacherAppointmentList $teacherAppointmentList)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeacherAppointmentList $teacherAppointmentList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherAppointmentListRequest $request, TeacherAppointmentList $teacherAppointmentList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeacherAppointmentList $teacherAppointmentList)
    {
        //
    }
}
