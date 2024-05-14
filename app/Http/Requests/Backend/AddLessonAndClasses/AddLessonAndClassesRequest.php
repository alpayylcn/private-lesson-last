<?php

namespace App\Http\Requests\Backend\AddLessonAndClasses;

use App\Http\Requests\Traits\ValidateAddUserTrait;
use Illuminate\Foundation\Http\FormRequest;

class AddLessonAndClassesRequest extends FormRequest
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
            'lesson_id' =>[
                'required'                 
            ],
            'class_id'=>[
                'required' 
            ]
            
        ];
        return array_merge($this->addUserRules(),$rules);
  
    }
    public function messages()
    {
        return array_merge(parent::messages(),$this->customMessages(),
        [
            'lesson_id.required' => 'Lütfen Ders Seçimi Yapınız...',
            'class_id.required' => 'Lütfen Ders İle Birlikte Sınıf Seçimi Yapınız...',
        ]);
    }
    
}
