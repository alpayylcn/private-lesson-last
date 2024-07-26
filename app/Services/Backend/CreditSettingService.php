<?php
namespace App\Services\Backend;

use App\Models\Backend\CreditSetting;


class CreditSettingService
{
    public function getSettings()
    {
        return CreditSetting::first();
    }

    public function updateSettings(array $data)
    {
        $creditSetting = CreditSetting::first();
        $creditSetting->update($data);
    }
}