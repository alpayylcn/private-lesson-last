<?php

namespace App\Http\Requests\Backend\UserDetails;

use App\Http\Requests\Traits\ValidateUserTrait;
use Illuminate\Foundation\Http\FormRequest;

class UserDetailRequest extends FormRequest
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
            'email' =>[
                'required',
            ],
            'phone' =>[
                'required',
            ],
            'city' =>[
                'required',
            ],
            'county' =>[
                'required',
            ],
            
        ];
        return array_merge($this->addUserRules(),$rules);
    }
    public function messages()
    {
        return array_merge(parent::messages(),$this->customMessages(),
        [
            'name.required' => 'Lütfen Adınızı Yazınız...',
            'name.string' => 'Adınız haflerden oluşmalıdır...',
            'name.max' => 'En fazla 20 karakter yazabilirsiniz...',
            'name.min' => 'En az 2 karakter yazmalısınız...',
            'surname.required' => 'Lütfen Soyadınızı Yazınız...',
            'surname.string' => 'Soyadınız haflerden oluşmalıdır...',
            'surname.max' => 'En fazla 20 karakter yazabilirsiniz...',
            'surname.min' => 'En az 2 karakter yazmalısınız...',
            'email.required' => 'Bu alan boş bırakılamaz...',
            'phone.required' => 'Bu alan boş bırakılamaz...',
            'city.required' => 'Bu alan boş bırakılamaz...',
            'county.required' => 'Bu alan boş bırakılamaz...',
        ]);
    }
}
