<?php
namespace App\Services\Backend;

use App\Models\Backend\LessonRequest;
use App\Models\Backend\LessonRequestToTeacher;
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
        $requestDuration = RequestDuration::first();
          
        // Öğrenci ders talebini oluştur
        $lessonRequest = LessonRequest::create([
            'student_id' => $student->id,
            'lesson_id' => $lessonId,
            'session_id' => $sessionId,
            'request_duration' => $requestDuration->duration_days,
        ]); 
    
        // İlgili dersi veren öğretmenlere talebi gönder
        $teacherIds = TeacherToLessonAndClass::where('lesson_id', $lessonId)
            ->pluck('user_id')
            ->unique(); // Tekil öğretmen ID'leri al
    
        foreach ($teacherIds as $teacherId) {
            $lessonRequest->teachers()->attach($teacherId,['approved' => false]);//lesson_request_to_teachers tablosuna kayıt ekle 'approved' sütununu false olarak ayarlıyoruz
            // User::find($teacherId)->notify(new LessonRequestedNotification($lessonRequest)); // Öğretmenlere bildirim gönderme işlemi
        }
    
        return ['lessonRequest' => $lessonRequest, 'teacherIds' => $teacherIds];
    }

    public function getLessonRequestsForTeacher($teacherId)
    {
        // Öğretmenin derslerini al
        $teacherLessons = TeacherToLessonAndClass::where('user_id', $teacherId)->pluck('lesson_id')->toArray();

        // lesson_request_to_teachers tablosundaki deleted_at sütununu kontrol ederek lesson_request'leri filtreleyin
        // Onaylanmış ders taleplerini al
        $approvedRequestIds = LessonRequestToTeacher::where('teacher_id', $teacherId)
        ->whereNull('deleted_at')
        ->where('approved', true) // Onaylanmış talepler
        ->pluck('lesson_request_id');

        $approvedRequests = LessonRequest::whereIn('id', $approvedRequestIds)
        ->whereIn('lesson_id', $teacherLessons)
        ->with('student', 'lesson')
        ->get();

        // Onaylanmamış ders taleplerini al
        $unapprovedRequestIds = LessonRequestToTeacher::where('teacher_id', $teacherId)
            ->whereNull('deleted_at')
            ->where('approved', false) // Onaylanmamış talepler
            ->pluck('lesson_request_id');

        $unapprovedRequests = LessonRequest::whereIn('id', $unapprovedRequestIds)
            ->whereIn('lesson_id', $teacherLessons)
            ->with('student', 'lesson')
            ->get();
       
          // Ders taleplerinin her biri için ek verileri işleyin
        $approvedRequests->each(function ($request) {
            $request->required_credits = $this->getApprovalCost($request->approval_count);
            $request->formatted_request_time = Carbon::parse($request->created_at)->locale('tr')->diffForHumans();
        });

        $unapprovedRequests->each(function ($request) {
            $request->required_credits = $this->getApprovalCost($request->approval_count);
            $request->formatted_request_time = Carbon::parse($request->created_at)->locale('tr')->diffForHumans();
        });

        // İki farklı listeyi döndür
        return [
            'approvedRequests' => $approvedRequests,
            'unapprovedRequests' => $unapprovedRequests
        ];
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
        $existingApproval = $lessonRequest->teachers()
        ->wherePivot('teacher_id', $teacherId)
        ->wherePivot('approved', true)
        ->exists();

        if ($existingApproval) {
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
        $lessonRequest->teachers()->updateExistingPivot($teacherId, ['approved' => true]);
        // Onay sayısını güncelle
        $lessonRequest->approval_count = $lessonRequest->teachers()->wherePivot('approved', true)->count();
    
        // Tek bir onay alsa bile talebi "approved" olarak işaretle
        $lessonRequest->status = 'approved';
    
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
