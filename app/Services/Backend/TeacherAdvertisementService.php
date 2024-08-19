<?php
namespace App\Services\Backend;

use App\Models\Backend\Duration;
use App\Models\Backend\TeacherAdvertisement;
use App\Models\Backend\WalletTransaction;
use App\Models\User;
use Carbon\Carbon;

class TeacherAdvertisementService
{

     public function getTeacherAdvertisements($teacherId)
    {
        // Öğretmenin ilanlarını, duration bilgisi ile birlikte alıyoruz
        return TeacherAdvertisement::with('duration')
            ->where('teacher_id', $teacherId)
            ->get();
    }
    public function createAdvertisement(array $data)
    {
        $data['teacher_id'] = auth()->id();

        // İlanı kaydediyoruz, gün sayısını artık saklamıyoruz
        return TeacherAdvertisement::create($data);
    }

    public function spendCredits(User $user, $durationId, $reasonId)
    {
        

        // Öğretmenin son ilanını al
        $lastAdvertisement = TeacherAdvertisement::where('teacher_id', $user->id)
            ->orderBy('end_date', 'desc')
            ->first();

            if ($lastAdvertisement && $lastAdvertisement->end_date > Carbon::now()) {
                // Eğer aktif bir ilan varsa, yeni ilanın başlangıç tarihini son ilanın bitiş tarihinden sonra ayarla
                $startDate = Carbon::parse($lastAdvertisement->end_date);
            } else {
                // Eğer aktif ilan yoksa, başlangıç tarihini şu an olarak ayarla
                $startDate = Carbon::now();
            }
            // Duration nesnesini veritabanından al
            $duration = Duration::findOrFail($durationId);
            // İlanın başlangıç ve bitiş tarihlerini ayarlıyoruz
            $data['start_date'] = $startDate;
            $data['end_date'] = $startDate->copy()->addDays($duration->days);
            
            $data['duration_id']=$durationId;
            $data['teacher_id'] = $user->id;
            $data['approved'] = true;

            $TeacherAdvertisement= TeacherAdvertisement::create($data);

        if (!empty($TeacherAdvertisement)){
             // İlgili kredi miktarını bul
             $creditSetting = Duration::where('id', $durationId)->firstOrFail();
             $creditAmount = $creditSetting->price;

             // Cüzdandaki bakiyeyi kontrol et
             if ($user->wallet->balance < $creditAmount) {
                 return response()->json(['message' => 'Yetersiz bakiye'], 400);
             }

             // Krediyi düş ve işlemi kaydet
             $user->wallet->decrement('balance', $creditAmount);
             $WalletTransaction=WalletTransaction::create([
                 'wallet_id' => $user->wallet->id,
                 'amount' => $creditAmount,
                 'reason_id' => $reasonId, // Harcama nedeni ID'si
                 'transaction_type' => 'expenditure'
             ]);

        }

               

        if(!empty($WalletTransaction)&& !empty($TeacherAdvertisement)){
            return response()->json(['message' => 'İlan başarıyla verildi'], 200);
        }else{
            return response()->json(['message' => 'İlan verirken bir hata oluştu.'], 400);
        }
        
    }
    public function deleteAdvertisement($id)
    {
        $advertisement = TeacherAdvertisement::findOrFail($id);
        $advertisement->delete(); // Soft delete işlemi
    }

    public function restoreAdvertisement($id)
    {
        $advertisement = TeacherAdvertisement::withTrashed()->findOrFail($id);
        $advertisement->restore(); // Soft delete işlemini geri alma
    }
}
