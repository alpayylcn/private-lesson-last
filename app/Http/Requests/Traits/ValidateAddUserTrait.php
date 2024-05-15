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
            'add_user_id.required' => 'Kullanıcı bilgisi alınamadı.',
            'add_user_id.int' => 'Kullanıcı kimliği sayı formatında olmalıdır.',
            'add_user_id.exists' => 'Bu kullanıcı geçersiz veya mevcut değil.',
            
        ];
    }
}