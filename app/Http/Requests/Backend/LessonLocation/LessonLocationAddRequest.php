<?php

namespace App\Http\Requests\Backend\LessonLocation;

use App\Http\Requests\Traits\ValidateAddUserTrait;
use App\Http\Requests\Traits\ValidateUserTrait;
use Illuminate\Foundation\Http\FormRequest;

class LessonLocationAddRequest extends FormRequest
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
           'title'=>[
                'required',
             ],
             'teacher_title'=>[
                'required',
             ],
             
        ];
        return array_merge($this->addUserRules(),$rules); 
    }

    public function messages()
    {
        return array_merge(parent::messages(),$this->customMessages(),
        [
            
            'title.required' => 'Başlık boş bırakılamaz...',
            'teacher_title.required' => 'Başlık boş bırakılamaz...',
            
           
        ]);
    }
}
