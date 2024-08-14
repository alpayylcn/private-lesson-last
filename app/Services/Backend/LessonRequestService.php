<?php
namespace App\Services\Backend;

use App\Models\Backend\LessonRequest;
use App\Models\Backend\RequestDuration;
use App\Models\Backend\TeacherToLessonAndClass;
use App\Models\Backend\Wallet;
use App\Models\TeacherLesson;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

class LessonRequestService
{
    public function requestLesson($lessonId)
    {
        $student = Auth::user();
        $sessionId = FacadesSession::getId();
        $requestDuration=RequestDuration::first();
        
        // Öğrenci ders talebini oluştur
        $lessonRequest = LessonRequest::create([
            'student_id' => $student->id,
            'lesson_id' => $lessonId,
            'session_id'=>$sessionId,
            'request_duration'=>$requestDuration->duration_days,
        ]); 

        // İlgili dersi veren öğretmenlere talebi gönder
        $teachers = TeacherToLessonAndClass::where('lesson_id', $lessonId)->get();
        
         // Öğretmenlere bildirim gönderme işlemi
          foreach ($teachers as $teacherLesson) {
             // Örnek bildirim gönderme işlemi
             // $teacherLesson->teacher->notify(new LessonRequestedNotification($lessonRequest));
        }
        return ['lessonRequest' => $lessonRequest, 'teachers' => $teachers];
    }

    public function getLessonRequestsForTeacher($teacherId)
    {
        $teacherLessons = TeacherToLessonAndClass::where('user_id', $teacherId)->pluck('lesson_id')->toArray();

       
        $lessonRequest = LessonRequest::whereIn('lesson_id', $teacherLessons)->with('student', 'lesson')->get();
        // Her bir ders talebi için gereken kredi miktarını hesaplayın
        foreach ($lessonRequest as $request) {
            $request->required_credits = $this->getApprovalCost($request->approval_count);
            $request->formatted_request_time = Carbon::parse($request->created_at)->locale('tr')->diffForHumans();

            
        }
        // Talep zamanını formatlayın
          return $lessonRequest;
    }

    public function getLessonRequestsForStudent(int $studentId)
    {
        
         $lessonRequest = LessonRequest::where('student_id', $studentId)->get();
         foreach ($lessonRequest as $request) {
            
            $request->formatted_request_time = Carbon::parse($request->created_at)->locale('tr')->diffForHumans();
        }
         return $lessonRequest;
    }
    
    public function cancelRequest($id)
    {
        $lessonRequest = LessonRequest::findOrFail($id);

        if ($lessonRequest) {
            $lessonRequest->delete(); // Soft delete the record
            return ['success' => true, 'message' => 'Talep başarıyla iptal edildi.'];
        }

        return ['success' => false, 'message' => 'Talep iptal edilemedi.'];
    }

    public function approveRequest($requestId)
    {
        $teacherId = Auth::id();

        // Talebi bul ve onay sayısını kontrol et
        $lessonRequest = LessonRequest::find($requestId);

        if ($lessonRequest->approval_count >= 5) {
            return response()->json([
                'status' => 400,
                'message' => 'Bu ders talebi zaten 5 öğretmen tarafından onaylandı.'
            ], 400);
        }

        // Onaylayan öğretmenlerin kimliklerini al
        $approvedTeachers = json_decode($lessonRequest->approved_teachers, true) ?? [];

        // Öğretmenin zaten onaylayıp onaylamadığını kontrol et
        if (in_array($teacherId, $approvedTeachers)) {
            return response()->json([
                'status' => 400,
                'message' => 'Bu dersi zaten onayladınız.'
            ], 400);
        }

        // Öğretmenin cüzdanını kontrol et
        $wallet = Wallet::where('user_id', $teacherId)->first();
        $requiredCredits = $this->getApprovalCost($lessonRequest->approval_count);
        if (!$wallet || $wallet->balance < $requiredCredits) {
            return response()->json([
                'status' => 400,
                'message' => 'Yeterli krediniz yok.'
            ], 400);
        }

        // Kredi kesme işlemi
        $wallet->balance -= $requiredCredits;
        $wallet->save();

        // Talebi onaylama işlemi
        $approvedTeachers[] = $teacherId;
        $lessonRequest->approved_teachers = json_encode($approvedTeachers);
        $lessonRequest->approval_count = count($approvedTeachers);
        $lessonRequest->status = 'approved'; // Onaylı olarak işaretle
        $lessonRequest->save();
   
        // Öğrenci telefon numarası bilgisi
        $studentPhoneNumber = $lessonRequest->student->userDetails->phone;

        return response()->json([
            'status' => 200,
            'message' => 'Ders talebi başarıyla onaylandı.',
            'phone' => $studentPhoneNumber
        ]);
    }

    private function getApprovalCost(int $approvalCount)
    {
        switch ($approvalCount) {
            case 0: return 100;
            case 1: return 90;
            case 2: return 80;
            case 3: return 70;
            case 4: return 60;
            default: return 0;
        }
    }
}
