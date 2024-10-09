<?php


namespace App\Services\Backend;

use App\Jobs\DeactivateAdvertisement;
use App\Models\Backend\StepOptionTitle;
use App\Models\Backend\TeacherAdvertisement;
use App\Models\StudentPrivateLessonSearch;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Response;

class TeacherCardService
{ 

    /**
     * Onaylı öğretmen ID'lerini al.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getApprovedTeacherIds()
    {
        return TeacherAdvertisement::where('approved', 1)
            ->distinct('teacher_id')
            ->pluck('teacher_id');
    }

    /**
     * Öğretmenler ve ilk onaylı ilanlarını al.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTeachersWithFirstApprovedAdvertisement()
    {
        $teacherIds = $this->getApprovedTeacherIds();

        return User::whereIn('id', $teacherIds)
            ->where('approved', 1) // Öğretmenin onaylı olup olmadığını kontrol et
            ->with(['advertisements' => function ($query) {
                $query->where('approved', 1)->limit(1); // Onaylı ilanın ilkini seç
            }])
            ->inRandomOrder() // Rastgele sırala
            ->get();
    }
    
    public function spendCredits(User $user, $amount, $reason,  $duration)
    {
        $wallet = $user->wallet;

        if ($wallet->balance >= $amount) {
            $wallet->balance -= $amount;
            $wallet->spending_reason = $reason;
            $wallet->save();

            // İlan verildiği için has_advertisement alanını true yap
            $user->userDetails->has_advertisement = true;
            $user->userDetails->save();

            // Süre sonunda has_advertisement alanını false yapmak için job oluştur
            $delay = null;
            if ($duration === 'weekly') {
                $delay = Carbon::now()->addWeek();
            } elseif ($duration === 'monthly') {
                $delay = Carbon::now()->addMonth();
            } elseif ($duration === 'yearly') {
                $delay = Carbon::now()->addYear();
            }

            if ($delay) {
                DeactivateAdvertisement::dispatch($user->id)->delay($delay);
            }
            return response()->json(['message' => 'Credits spent successfully'], 200);
        }

        return response()->json(['message' => 'Insufficient balance'], 400);
    }



    public function searchTeachersByStudentCriteria($studentId)
    {
        // Öğrencinin arama kriterlerini al
    $searchCriteria = StudentPrivateLessonSearch::where('student_id', $studentId)->get();

    // Filtrelemeyi ders, sınıf ve nerede olacağına göre yapacağız
    $lessonId = $searchCriteria->where('step_question_id', 1)->first()->step_option_id;
    $classId = $searchCriteria->where('step_question_id', 2)->first()->step_option_id;
    $locationIdRef = $searchCriteria->where('step_question_id', 3)->first()->step_option_id; // 1: Online, 2: Ofis

    // Referans id'ye göre step option title tablosundan option id değerini çekiyoruz. Öğretmenler buna göre filtrelenecek
    $location = StepOptionTitle::where('id', $locationIdRef)->first();
    $locationId = $location->option_id;
    $locationTitle = $location->title;
   
    // Sorguyu öğretmenlere göre başlat
    $query = User::query()
        ->whereHas('teacherToLessonAndClasses', function ($q) use ($lessonId, $classId) {
            $q->where('lesson_id', $lessonId)
              ->where('class_id', $classId);
        })
        ->whereHas('teacherToLocations', function ($q) use ($locationId) {
            $q->where('location_id', $locationId); // Dersi nerede verdiğini kontrol ediyoruz
        })
        // Öğretmenin aktif bir ilanı olup olmadığını kontrol ediyoruz
        ->whereHas('advertisements', function ($q) {
            $q->where('end_date', '>', now()); // Bitiş tarihi bugünden sonra olan ilanları kontrol ediyoruz
        });

    // Eğer öğrenci "online" seçmediyse il ve ilçe bilgilerini de filtrelemeye ekle
    if ($locationTitle != 'Online') { // Online değilse
        $studentCityId = $searchCriteria->first()->student_city_id;
        $studentCountryTownId = $searchCriteria->first()->student_country_town_id;

        // İlgili il ve ilçe bilgileri öğretmenin UserDetails tablosunda kontrol edilecek
        $query->whereHas('userDetails', function ($q) use ($studentCityId, $studentCountryTownId) {
            $q->where('city', $studentCityId)
              ->where('county', $studentCountryTownId);
        });
    }

    // Sonuçları getir random sırala
    return $query->inRandomOrder()->get();
    }


}
