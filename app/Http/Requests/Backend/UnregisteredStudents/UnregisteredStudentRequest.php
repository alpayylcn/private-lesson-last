<?php

namespace App\Http\Requests\Backend\UnregisteredStudents;

use App\Http\Requests\Traits\ValidateUserTrait;
use Illuminate\Foundation\Http\FormRequest;

class UnregisteredStudentRequest extends FormRequest
{   
    use ValidateUserTrait;
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            
            'name' =>[
                'required',
                'string',
                'max:20', 
                'min:2',                
            ],
            'surname' =>[
                'required', 
                'string',
                'max:20', 
                'min:2',                
            ],
            'mail' =>[
                'required',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'email'
            ],
            'phone' =>[
                'required', 
                'regex:/^0\(\d{3}\) \d{3} \d{2} \d{2}$/', // Türkiye formatı 
            ],
           
            
        ];
        return $rules;
    }
    public function messages()
    {
        return 
        [
            'name.required' => 'Lütfen Adınızı Yazınız...',
            'name.string' => 'Adınız haflerden oluşmalıdır...',
            'name.max' => 'Adınız alanına en fazla 20 karakter yazabilirsiniz...',
            'name.min' => 'Adınız alanına en az 2 karakter yazmalısınız...',
            'surname.required' => 'Lütfen Soyadınızı Yazınız...',
            'surname.string' => 'Soyadınız haflerden oluşmalıdır...',
            'surname.max' => 'Soyad alanına en fazla 20 karakter yazabilirsiniz...',
            'surname.min' => 'Soyad alanına en az 2 karakter yazmalısınız...',
            'mail.required' => 'E Mail alanı boş bırakılamaz...',
            'mail.regex' => 'E Mail alanı formata uygun olmalı...',
            'mail.email' => 'Geçerli bir E Mail adresi girin...',
            'phone.required' => 'Telefon alanı boş bırakılamaz...',
            'phone.regex' => 'Lütfen telefon numaranızı formata uygun olarak yazınız... ',
            
            
        ];
    }
}
