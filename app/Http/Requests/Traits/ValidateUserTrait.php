<?php

namespace App\Http\Requests\Traits;

trait ValidateUserTrait{

    protected function addUserRules()
    {
       
        return  [
            'user_id' => [
            'required',
            'int',
            'exists:users,id',
        ]];
    }

    public function customMessages()
    {
        return  [
            'user_id.required' => 'Kullanıcı bilgisi alınamadı.',
            'user_id.int' => 'Kullanıcı kimliği sayı formatında olmalıdır.',
            'user_id.exists' => 'Bu kullanıcı geçersiz veya mevcut değil.',
            
        ];
    }
}