<?php
namespace App\Services\Backend;

use App\Models\Backend\DepositLimit;
use Ramsey\Uuid\Type\Decimal;

class DepositLimitService
{
    public function firstDeposit()
    {
        return DepositLimit::first();
    }
    public function updateDepositLimit($depositLimitId, $depositLimit)
    {   //dd($depositLimitId,$depositLimit);
        $deposit = DepositLimit::find($depositLimitId);
        if ($deposit) {
            $deposit->limit = $depositLimit;
            $deposit->save();
            return true;
        }
        return false;
    }
}