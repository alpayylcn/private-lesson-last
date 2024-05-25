<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\ValidateUserTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStepOptionTitleRequest extends FormRequest
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
            'title'=>[
                 'required',
              ],
            'question_id'=>[
                'required'
              ]
            
              
         ];
         return array_merge($this->addUserRules(),$rules); 
    }

    public function messages()
    {
        return array_merge(parent::messages(),$this->customMessages(),
        [
            
            'title.required' => 'Öğrencinin Göreceği Başlık Boş Bırakılamaz...',
            'question_id.required' => 'Başlığı hangi sorunun altına ekleyeceğinizi seçmelisiniz...',
           
           
        ]);
    }
}
