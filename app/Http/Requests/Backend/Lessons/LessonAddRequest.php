<?php

namespace App\Http\Requests\Backend\Lessons;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Http\Requests\Traits\ValidateAddUserTrait;

class LessonAddRequest extends FormRequest
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
        // $option = [
        //     'required',
        //     Rule::in(['add','spent']), // Enum değerlerini buraya yazın
        // ];
        // if ($this->has('lesson_id'))
        // {
        //     $rules['lesson_id'] = $option;
        // }

        $rules = [
            'title' =>[
                'required',
                'string',
                'max:25',
                'min:4',
                'unique:lessons,title'
            ],
        ];
        return array_merge($this->addUserRules(),$rules); 
        
    }

    public function messages()
    {
        return array_merge(parent::messages(),$this->customMessages(),
        [
            'title.required' => 'Ders Adı Boş Bırakılamaz...',
            'title.max' => 'Ders Adı En Fazla 25 Karakter Olabilir...',
            'title.min' => 'Ders Adı En Az 4 Karakter Olmalı...',
            'title.unique'=>'Bu Ders Daha Önce Kaydedilmiş, Pasif Durumdaki Dersleri Kontrol Ediniz...'
        ]);
    }
}
