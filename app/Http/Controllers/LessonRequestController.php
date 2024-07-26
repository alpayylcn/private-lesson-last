<?php

namespace App\Http\Controllers;

use App\Models\Backend\Lesson;
use App\Services\Backend\LessonRequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonRequestController extends Controller
{
    public function __construct(protected LessonRequestService $lessonRequestService){}   
    public function showRequestForm()
    {
        $lessons = Lesson::all();
        return view('teachers.ogrenci_talep', compact('lessons'));
    }

    public function requestLesson(Request $request)
    {
        $lessonId = $request->input('lesson_id');
        $result = $this->lessonRequestService->requestLesson($lessonId);

        return response()->json([
            'message' => 'Ders talebiniz gönderildi.',
            'teachers' => $result['teachers']
        ]);
    }

    public function showApprovePage()
    {
        $teacherId = Auth::id();
        $lessonRequests = $this->lessonRequestService->getLessonRequestsForTeacher($teacherId);
        //dd($lessonRequests);
        return view('teachers.appointment_from_admin', compact('lessonRequests'));


    }

    public function approveRequest(Request $request)
    {
        $requestId = $request->input('request_id');
        $response = $this->lessonRequestService->approveRequest($requestId);

    return response()->json($response->original, $response->getStatusCode());
    }
}
