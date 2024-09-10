<?php
namespace App\Http\Requests\Backend\Durations;

use Illuminate\Foundation\Http\FormRequest;

class DurationRequest extends FormRequest
{
    public function authorize()
    {
        // Bu formun yetkilendirme kontrolü. Gerekirse burada yetkilendirme kontrolü yapabilirsiniz.
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'days' => 'required|integer|min:1|max:1080', // Gün sayısı 1080'den fazla olamaz
            'price' => 'required|numeric|min:1|max:100000', // Ücret 100000'den fazla olamaz
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'İlan adı zorunludur.',
            'name.string' => 'İlan adı bir metin olmalıdır.',
            'name.max' => 'İlan adı en fazla 255 karakter olabilir.',
            
            'days.required' => 'Gün sayısı zorunludur.',
            'days.integer' => 'Gün sayısı bir tamsayı olmalıdır.',
            'days.min' => 'Gün sayısı en az 1 gün olmalıdır.',
            'days.max' => 'Gün sayısı 1080 günden fazla olamaz.',

            'price.required' => 'Ücret zorunludur.',
            'price.numeric' => 'Ücret bir sayı olmalıdır.',
            'price.min' => 'Ücret en az 1 TL olmalıdır.',
            'price.max' => 'Ücret 100000 TL\'den fazla olamaz.',
        ];
    }
}
