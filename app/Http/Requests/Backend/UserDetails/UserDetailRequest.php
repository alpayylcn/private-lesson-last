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
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB = 2048KB
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
                'regex:/^0\(\d{3}\) \d{3} \d{2} \d{2}$/', // Türkiye formatı 
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
            'name.max' => 'Adınız alanına en fazla 20 karakter yazabilirsiniz...',
            'name.min' => 'Adınız alanına en az 2 karakter yazmalısınız...',
            'surname.required' => 'Lütfen Soyadınızı Yazınız...',
            'surname.string' => 'Soyadınız haflerden oluşmalıdır...',
            'surname.max' => 'Soyad alanına en fazla 20 karakter yazabilirsiniz...',
            'surname.min' => 'Soyad alanına en az 2 karakter yazmalısınız...',
            'email.required' => 'E Mail alanı boş bırakılamaz...',
            'phone.required' => 'Telefon alanı boş bırakılamaz...',
            'phone.regex' => 'Lütfen telefon numaranızı formata uygun olarak yazınız... ',
            'city.required' => 'Şehir alanı boş bırakılamaz...',
            'county.required' => 'İlçe alanı boş bırakılamaz...',
            'profile_image.image'=>'Sadece resim yükleyebilirsiniz...',
            'profile_image.max'=>'Resim Max.2MB olmalıdır...',
            'profile_image.mimes'=>'Sadece şu formatta resim yükleyebilirsiniz : jpeg, png, jpg, gif, svg...'
            
        ]);
    }
}
