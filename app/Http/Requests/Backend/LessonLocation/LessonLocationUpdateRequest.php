<?php

namespace App\Http\Requests\Backend\LessonLocation;

use App\Http\Requests\Traits\ValidateUserTrait;
use Illuminate\Foundation\Http\FormRequest;

class LessonLocationUpdateRequest extends FormRequest
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
            'title.*' =>[
                'required',
                // 'unique:step_questions,rank'
            ],  
           
        ];
        return array_merge($this->addUserRules(),$rules); 
    }

    public function messages()
    {
        return array_merge(parent::messages(),$this->customMessages(),
        [
            'title.*.required' => 'Başlıklar boş bırakılamaz...',
            'title.*.unique'=>'Sıra numaraları farklı olmalıdır...'
        ]);
    }
}
