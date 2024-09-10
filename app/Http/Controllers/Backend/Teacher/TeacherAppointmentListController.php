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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherAppointmentListController extends Controller
{
    public function __construct(
        protected  TeacherAppointmentListService $teacherAppointmentListService,
        
        ){}
    public function index()
    {
        $user_id=Auth::user()->id;
        $appointmentList=$this->teacherAppointmentListService->getWithWhere(['teacher_id'=>$user_id]);
        return view('teachers.appointment_from_student',compact('appointmentList'));
    }
    
    public function fromAdmin()
    {
        $lessonRequests = LessonRequest::with('student')->get();

        return view('teachers.appointment_from_admin', compact('lessonRequests'));
    }

    public function delete(Request $request)
    {
        $appointmentId = $request->input('appointment_id');
        
        $this->teacherAppointmentListService->deleteAppointment($appointmentId);

        return response()->json(['success' => true, 'message' => 'Randevu başarıyla silindi.']);
    }
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   dd($request);
        $this->validate($request, [
            'lesson_id' => 'required|exists:lessons,id',
            'class' => 'required|string|max:255',
            'note' => 'nullable|string|max:1000',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $data = $request->all();
        
        $this->teacherAppointmentListService->storeLessonRequest($data);

        return response()->json(['message' => 'Ders talebi başarıyla gönderildi!'], 200);
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
