<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WalletAddedMoney extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'wallet_added_money';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'wallet_id',
        'add_user_id',     
        'price',        
        'currency_id'       
                
    ];
    public function currency() :HasOne
    {
        return $this->hasOne(Currency::class,'id','currency_id');
    }
    public function add_user() :HasOne
        {
            return $this->hasOne(User::class,'id','add_user_id');
        } 
    public function wallet() :HasOne
        {
            return $this->hasOne(Wallet::class,'id','wallet_id');
        }     
}
