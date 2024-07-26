<?php

namespace App\Http\Controllers;

use App\Models\Backend\CreditSetting;
use App\Models\Backend\Reason;
use App\Models\User;
use App\Services\Backend\CreditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherCardController extends Controller
{
    public function __construct(protected CreditService $creditService){}   
    
   
    // İlan verme formunu göstermek için method
    public function showCreateAdvertisementForm()
    {
        $durations = CreditSetting::all();
        $reasons = Reason::all();

        return view('teacher_cards.create-advertisement', [
            'durations' => $durations,
            'reasons' => $reasons
        ]);
    }
    

    // Kredi harcama işlemini gerçekleştiren method
    public function spendCredits(Request $request)
    {
        $user = Auth::user();
        $durationId = $request->input('duration_id');
        $reasonId = $request->input('reason_id'); // Güncellenmiş şekilde reason_id

        return $this->creditService->spendCredits($user, $durationId, $reasonId);
    }
}
