<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'wallets';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'title',
        'user_id',     
        'balance',        
        'currency_id',        
        'is_active' ,
        'spending_reason',       
    ];
    public function currency() :HasOne
    {
        return $this->hasOne(Currency::class,'id','currency_id');
    } 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }
}
