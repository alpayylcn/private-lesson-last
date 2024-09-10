<?php

namespace App\Http\Controllers\Backend\SystemSettings;

use App\Http\Controllers\Controller;
use App\Models\Backend\RequestDuration;
use App\Services\Backend\DepositLimitService;
use App\Services\Backend\DurationService;
use App\Services\Backend\RequestDurationService;
use App\Services\Backend\TeacherOfferOrderAndPriceService;
use Illuminate\Http\Request;

class SystemSettingsController extends Controller
{
    public function __construct(
        protected RequestDurationService $requestDurationService,
        protected DepositLimitService $depositLimitService,
        protected DurationService $durationService,
        protected TeacherOfferOrderAndPriceService $teacherOfferOrderAndPriceService,
       ){}
       public function index()
    {
        $durations = $this->durationService->getAllDurations();
        $teacherOfferOrder = $this->teacherOfferOrderAndPriceService->getOffers();
        $requestDurationDay = $this->requestDurationService->firstDuration();
        $depositLimit=$this->depositLimitService->firstDeposit();
        return view('admin.system_settings.index', compact('durations','depositLimit','requestDurationDay','teacherOfferOrder'));
    }

    public function updateRequestDuration(Request $request)
    {
        
        $isUpdated = $this->requestDurationService->updateRequestDuration($request->duration_id, $request->duration_days);

        if ($isUpdated) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 500);
        }
    }

    public function updateDepositLimit(Request $request) //Para Yükleme Üst Sınırı
    {
        //dd($request);
        $isUpdated = $this->depositLimitService->updateDepositLimit($request->deposit_limit_id, $request->deposit_limit);

        if ($isUpdated) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 500);
        }
    }
}
