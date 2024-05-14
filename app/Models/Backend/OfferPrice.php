<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfferPrice extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'offer_prices';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'offer_id',
        'price',     
        'currency_id'        
    ];

    public function offer() :HasOne
    {
        return $this->hasOne(Offer::class,'id','offer_id');
    } 

    public function currency() :HasOne
    {
        return $this->hasOne(Currency::class,'id','currency_id');
    } 
}
