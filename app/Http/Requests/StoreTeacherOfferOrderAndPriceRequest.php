<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherOfferOrderAndPriceRequest extends FormRequest
{
    public function authorize()
    {
        return true; // İstekleri yetkilendirmek için true döndürün
    }

    public function rules()
    {
        return [
            
            'offer_price' => 'required|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            
            'offer_price.required' => 'Teklif Fiyatı Zorunludur.',
            'offer_price.numeric' => 'Teklif Fiyatı Geçerli Bir Sayı Olmalıdır.',
        ];
    }
}

