<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Services\Backend\LessonRequestService;
use App\Services\Backend\StudentPrivateLessonSearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonRequestListController extends Controller
{
    public function __construct(
        protected LessonRequestService $lessonRequestService,
        protected StudentPrivateLessonSearchService $studentPrivateLessonSearchService,
        
        ){} 

        public function index()
    {
         // Mevcut öğretmenin ID'sini al
    $studentId = Auth::id();
    
    // Öğretmenin ders taleplerini al
    $lessonRequests = $this->lessonRequestService->getLessonRequestsForStudent($studentId);
    
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
    return view('students.lesson_request_list', compact('lessonRequests', 'studentFiltersCollection'));


    }

    public function cancelRequest(Request $request)
    {
        $result = $this->lessonRequestService->cancelRequest($request->id);
        return response()->json($result);
    }
}
