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
    $lessonRequestsData = $this->lessonRequestService->getLessonRequestsForTeacher($teacherId);

    // Onaylanmış ve onaylanmamış talepler
    $approvedRequests = $lessonRequestsData['approvedRequests'];
    $unapprovedRequests = $lessonRequestsData['unapprovedRequests'];

    // Tüm session_id'lere göre filtrelenmiş verileri depolamak için bir koleksiyon oluştur
    $studentFiltersCollection = collect();

    // Onaylanmış talepler için filtreleri alın
    foreach ($approvedRequests as $request) {
        $studentFilters = $this->studentPrivateLessonSearchService->getWithWhere(['session_id' => $request->session_id]);
        $studentFiltersCollection = $studentFiltersCollection->concat($studentFilters);
    }

    // Onaylanmamış talepler için filtreleri alın
    foreach ($unapprovedRequests as $request) {
        $studentFilters = $this->studentPrivateLessonSearchService->getWithWhere(['session_id' => $request->session_id]);
        $studentFiltersCollection = $studentFiltersCollection->concat($studentFilters);
    }

    // Verileri Blade şablonuna gönder
    return view('teachers.appointment_from_admin', compact('approvedRequests', 'unapprovedRequests', 'studentFiltersCollection'));

    }

    public function approveRequest(Request $request)
    {
        //dd($request);
        $requestId = $request->input('request_id');
        $response = $this->lessonRequestService->approveRequest($request);

    return response()->json($response->original, $response->getStatusCode());
    }
}
