<?php

namespace App\Http\Requests\Traits;

trait ValidateAddUserTrait{

    protected function addUserRules()
    {
       
        return  [
            'add_user_id' => [
            'required',
            'int',
            'exists:users,id',
        ]];
    }

    public function customMessages()
    {
        return  [
            'add_user_id.required' => 'User alanı zorunludur.',
            'add_user_id.int' => 'User alanı sayı formatında olmalıdır.',
            'add_user_id.exists' => 'Bu User geçersiz veya mevcut değil.',
            
        ];
    }
}