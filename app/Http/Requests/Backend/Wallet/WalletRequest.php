<?php
namespace App\Http\Requests\Backend\Wallet;

use App\Models\Backend\DepositLimit;
use Illuminate\Foundation\Http\FormRequest;


class WalletRequest extends FormRequest
{
    public function authorize()
    {
        // Bu formun yetkilendirme kontrolü. Gerekirse burada yetkilendirme kontrolü yapabilirsiniz.
        return true;
    }

    public function rules()
    {
        // Veritabanından mevcut üst limiti al
        $depositLimit = DepositLimit::first()->limit ?? 0;

        return [
            // 'amount' input alanı için validasyon kuralları
            'amount' => "required|numeric|min:0|max:$depositLimit",
        ];
    }

    public function messages()
    {
        $depositLimit = DepositLimit::first()->limit ?? 0;
        return [
            'amount.required' => 'Yükleme tutarı zorunludur.',
            'amount.numeric' => 'Yükleme tutarı bir sayı olmalıdır.',
            'amount.min' => 'Yükleme tutarı negatif olamaz.',
            'amount.max' => "Yükleme tutarı $depositLimit  TL'yi aşamaz.",
        ];
    }
}
