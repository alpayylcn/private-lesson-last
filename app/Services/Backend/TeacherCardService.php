<?php


namespace App\Services\Backend;

use App\Jobs\DeactivateAdvertisement;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Response;

class TeacherCardService
{
    
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
}
