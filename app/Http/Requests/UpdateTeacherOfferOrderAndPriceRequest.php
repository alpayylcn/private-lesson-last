<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherOfferOrderAndPriceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'order' => 'required|integer|min:1',
            'offer_price' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'order.required' => 'Sıra numarası zorunludur.',
            'order.integer' => 'Sıra numarası geçerli bir sayı olmalıdır.',
            'offer_price.required' => 'Ücret zorunludur.',
            'offer_price.numeric' => 'Ücret geçerli bir sayı olmalıdır.',
        ];
    }
}
