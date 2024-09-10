<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherOfferOrderAndPrice extends Model
{
    use HasFactory;
    protected $table = 'teacher_offer_order_and_prices';
    
    protected $fillable = [
        'offer_order',
        'offer_price',
    ];
}
