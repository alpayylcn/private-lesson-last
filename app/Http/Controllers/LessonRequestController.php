<?php

namespace App\Http\Controllers;

use App\Models\Backend\Lesson;
use App\Services\Backend\LessonRequestService;
use App\Services\Backend\StudentPrivateLessonSearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonRequestController extends Controller
{
    public function __construct(
        protected LessonRequestService $lessonRequestService,
        protected StudentPrivateLessonSearchService $studentPrivateLessonSearchService,
        
        ){}   
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
         // Mevcut öğretmenin ID'sini al
    $teacherId = Auth::id();
    
    // Öğretmenin ders taleplerini al
    $lessonRequests = $this->lessonRequestService->getLessonRequestsForTeacher($teacherId);
    
    // Tüm session_id'lere göre filtrelenmiş verileri depolamak için bir koleksiyon oluştur
    $studentFiltersCollection = collect();

    // Her bir ders talebi için
    foreach ($lessonRequests as $request) {
        // İlgili session_id'ye göre filtrelenmiş verileri al
        $studentFilters = $this->studentPrivateLessonSearchService->getWithWhere(['session_id' => $request->session_id]);

        // Filtrelenmiş verileri koleksiyona ekle
        $studentFiltersCollection = $studentFiltersCollection->concat($studentFilters);
    }

    // Verileri Blade şablonuna gönder
    return view('teachers.appointment_from_admin', compact('lessonRequests', 'studentFiltersCollection'));


    }

    public function approveRequest(Request $request)
    {
        $requestId = $request->input('request_id');
        $response = $this->lessonRequestService->approveRequest($requestId);

    return response()->json($response->original, $response->getStatusCode());
    }
}
