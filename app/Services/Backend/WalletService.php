<?php
namespace App\Services\Backend;

use App\Models\Backend\Currency;
use App\Models\Backend\Wallet;
use App\Models\Backend\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletService{

    public function __construct(protected Wallet $wallet){} 
     
    
    public function addMoney($amount)
    {
       // Kullanıcının aktif cüzdanını al
        $wallet = Wallet::firstOrCreate(
        ['user_id' => Auth::id(), 'is_active' => true],
        ['balance' => 0]
    );

    // Para birimini currencies tablosundan alalım
    $currency = Currency::where('code', 'TRY')->first(); // TRY yerine istediğiniz para birimi kodunu kullanabilirsiniz.

    // Bakiyeyi güncelle
    $wallet->balance += $amount;
    $wallet->save();

    // İşlemi kaydet
    WalletTransaction::create([
        'wallet_id' => $wallet->id,
        'amount' => $amount,
        'transaction_type' => 'deposit',
        'currency_id' => $currency->id,
    ]);

    return $wallet;
    }
    public function create(array $walletData){

        return $this->wallet->create($walletData);
        
    }

    public function update(array $walletData,int $id=0){
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->update($walletData);
        }
            return false;
        
    }

    public function delete(int $id){

            $first=$this->first(['id'=>$id]);
            return $first->delete();
    }

    public function getWithWhere(array $where = [])
   {
       // Veritabanı sorgusu oluştur
       $query = $this->wallet->query();

       // 'where' koşullarını eklemek için dizi içinde gelen koşulları döngüye al
       if(is_array($where))
       {
           foreach ($where as $column => $value)
           {
               $query->where($column, $value);
           }
       }
       return $query->orderByDesc('id')->get();
    }

    public function first(array $where)
   {
         // Veritabanı sorgusu oluştur
         $query = $this->wallet->query();

         // 'where' koşullarını eklemek için dizi içinde gelen koşulları döngüye al
         if(is_array($where))
         {
             foreach ($where as $column => $value)
             {
                 $query->where($column, $value);
             }
         }
         return $query->orderByDesc('id')->first();
         // Sayfalama işlemini yapmak için model
        }
        public function find(){

        }
        public function pagination(){

            
        }
    }