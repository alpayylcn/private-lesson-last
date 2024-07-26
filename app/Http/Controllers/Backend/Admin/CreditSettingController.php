<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Services\Backend\CreditSettingService;
use Illuminate\Http\Request;

class CreditSettingController extends Controller
{
    public function __construct(
        protected CreditSettingService $creditSettingService,
        
    ){}

    public function edit()
    {
        $creditSetting = $this->creditSettingService->getSettings();
        return view('admin.credit_settings.edit', compact('creditSetting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'weekly_credits' => 'required|integer',
            'monthly_credits' => 'required|integer',
            'yearly_credits' => 'required|integer',
            'first_offer' => 'required|integer',
            'second_offer' => 'required|integer',
            'third_offer' => 'required|integer',
            'fourth_offer' => 'required|integer',
            'fifth_offer' => 'required|integer',
        ]);

        $this->creditSettingService->updateSettings($request->all());

        return redirect()->route('admin.credit-settings.edit')->with('success', 'Kredi ayarları başarıyla güncellendi.');
    }
}
