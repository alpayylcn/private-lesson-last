<?php

namespace App\Http\Controllers;

use App\Models\Backend\LessonRequestToTeacher;
use App\Http\Requests\StoreLessonRequestToTeacherRequest;
use App\Http\Requests\UpdateLessonRequestToTeacherRequest;
use App\Services\Backend\LessonRequestToTeacherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonRequestToTeacherController extends Controller
{
    

    public function __construct(
        protected LessonRequestToTeacherService $lessonRequestToTeacherService,
        ){}  

        public function removeTeacher(Request $request)
        {
            $lessonRequestId = $request->input('request_id');
            $teacherId = Auth::user()->id;
    
            // Öğretmeni ders talebinden kaldırma işlemi
            $success = $this->lessonRequestToTeacherService->removeTeacher($lessonRequestId, $teacherId);
    
            if ($success) {
                return response()->json(['status' => 200, 'message' => 'Öğretmen başarıyla listeden kaldırıldı.']);
            } else {
                return response()->json(['status' => 400, 'message' => 'Öğretmen kaldırılırken bir hata oluştu.'], 400);
            }
        }    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequestToTeacherRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LessonRequestToTeacher $lessonRequestToTeacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LessonRequestToTeacher $lessonRequestToTeacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonRequestToTeacherRequest $request, LessonRequestToTeacher $lessonRequestToTeacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LessonRequestToTeacher $lessonRequestToTeacher)
    {
        //
    }
}
