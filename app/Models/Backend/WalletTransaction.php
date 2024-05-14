<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WalletTransaction extends Model
{
    use HasFactory;
    
    public $timestamps = true;
    protected $table = 'wallet_transactions';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'wallet_transaction_type_id',
        'type',        
        'relation_id'       
                
    ];
    public function wallet_transaction_type() :HasOne
        {
            return $this->hasOne(WalletTransactionType::class,'id','wallet_transaction_type_id');
        } 
        public function add_money_relation() :HasOne
        {
            return $this->hasOne(WalletAddedMoney::class,'id','relation_id')->where('type',1);
        } 
        public function spent_money_relation() :HasOne
        {
            return $this->hasOne(WalletSpentMoney::class,'id','relation_id')->where('type',0);
        } 

    //???? eğer yükleme type ı varsa  wallet_added_money tablosunun id sini alacak, harcama varsa WalletSpentMoney tablosunun id sini alacak
}
