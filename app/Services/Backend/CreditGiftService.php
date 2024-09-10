<?php
namespace App\Services\Backend;

use App\Models\Backend\CreditSetting;
use App\Models\Backend\Currency;
use App\Models\Backend\Duration;
use App\Models\Backend\Wallet;
use App\Models\User;

use App\Models\Backend\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreditGiftService
{
    public function getTeachersWithWalletsPaginated($perPage, $searchTerm = null)
    {
         // "teacher" rolüne sahip olan kullanıcıları alıyoruz
         return User::role('Teacher')  // Spatie'nin role methodu kullanılıyor
         ->with('wallet');         // Cüzdan ilişkisi ile birlikte
         // Eğer bir arama terimi varsa ad, soyad veya e-posta üzerinden filtreleme yapıyoruz
        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('surname', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }

        return $query->paginate($perPage); // Sayfalama işlemi

    }

    public function addMoney(int $teacherId,int $amount)
    {
        //dd($teacherId,$amount);
       // Kullanıcının aktif cüzdanını al
        $wallet = Wallet::firstOrCreate(
        ['user_id' => $teacherId, 'is_active' => true],
        ['balance' => 0]
        
    );
    //dd($wallet);
    // Para birimini currencies tablosundan alalım
    $currency = Currency::where('code', 'TRY')->first(); // TRY yerine istediğiniz para birimi kodunu kullanabilirsiniz.

    // Bakiyeyi güncelle
    $wallet->balance += $amount;
    $wallet->save();

    // İşlemi kaydet
    WalletTransaction::create([
        'wallet_id' => $wallet->id,
        'amount' => $amount,
        'transaction_type' => 'gift',
        'currency_id' => $currency->id,
    ]);

    return $wallet;
    }
    
}
