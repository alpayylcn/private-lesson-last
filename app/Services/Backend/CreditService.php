<?php
namespace App\Services\Backend;

use App\Models\Backend\CreditSetting;
use App\Models\Backend\Duration;
use App\Models\User;

use App\Models\Backend\WalletTransaction;

class CreditService
{
    public function spendCredits(User $user, $durationId, $reasonId)
    {
        // İlgili kredi miktarını bul
        $creditSetting = Duration::where('id', $durationId)->firstOrFail();
        $creditAmount = $creditSetting->price;

        // Cüzdandaki bakiyeyi kontrol et
        if ($user->wallet->balance < $creditAmount) {
            return response()->json(['message' => 'Yetersiz bakiye'], 400);
        }

        // Krediyi düş ve işlemi kaydet
        $user->wallet->decrement('balance', $creditAmount);
        WalletTransaction::create([
            'wallet_id' => $user->wallet->id,
            'amount' => $creditAmount,
            'reason_id' => $reasonId, // Harcama nedeni ID'si
            'transaction_type' => 'expenditure'
        ]);

        return response()->json(['message' => 'İlan başarıyla verildi'], 200);
    }
}
