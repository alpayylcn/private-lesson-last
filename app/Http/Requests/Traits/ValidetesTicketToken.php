<?php

namespace App\Http\Requests\Traits;

trait ValidatesTicketToken
{
    protected function tokenRules()
    {
        return  [
            'ticket_token' => [
            'required',
            'string',
            'regex:/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i',
            'exists:student_quiz_ticket,quiz_token', //'unique:lessons,title',
        ]];
    }

    public function customMessages()
    {
        return  [
            'ticket_token.required' => 'Token alanı zorunludur.',
            'ticket_token.string' => 'Token alanı metin formatında olmalıdır.',
            'ticket_token.regex' => 'Token alanı geçerli bir UUID formatında olmalıdır.',
            'token.exists' => 'Bu token geçersiz veya mevcut değil.',
            'token.unique'=>'Mesaj',
        ];
    }
}