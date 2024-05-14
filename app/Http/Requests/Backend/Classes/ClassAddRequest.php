<?php

namespace App\Http\Requests\Backend\Classes;

use App\Http\Requests\Traits\ValidateAddUserTrait;
use Illuminate\Foundation\Http\FormRequest;

class ClassAddRequest extends FormRequest
{   
    use ValidateAddUserTrait;
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
            'title' =>[
                'required',
                'string',
                'max:25',
                'min:4',
                'unique:classes,title'
            ],
        ];
        return array_merge($this->addUserRules(),$rules);
    }
    public function messages()
    {
        return array_merge(parent::messages(),$this->customMessages(),
        [
            'title.required' => 'Sınıf Adı Boş Bırakılamaz...',
            'title.max' => 'Sınıf Adı En Fazla 25 Karakter Olabilir...',
            'title.min' => 'Sınıf Adı En Az 4 Karakter Olmalı...',
            'title.unique'=>'Bu Sınıf Daha Önce Kaydedilmiş, Pasif Durumdaki Sınıfları Kontrol Ediniz...'
        ]);
    }
}
