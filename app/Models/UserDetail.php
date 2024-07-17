<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'email',
        'phone',
        'gender',
        'city',
        'county',
        'district',
        'profile_image',
        'approved',
        
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }
    public function countyName():HasOne{
        return $this->hasOne(County::class,'id','county');
    } 
    public function cityName():HasOne{
        return $this->hasOne(City::class,'id','city');
    } 

    // Telefon numarasını temizleyen mutator Otomatik formatta bulunan parantez ve tireleri atar
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = preg_replace('/\D/', '', $value);
    }
}
