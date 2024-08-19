<?php

namespace App\Http\Controllers;

use App\Models\Backend\CreditSetting;
use App\Models\Backend\Duration;
use App\Models\Backend\Reason;
use App\Models\Backend\TeacherAdvertisement;
use App\Models\Backend\Wallet;
use App\Models\User;
use App\Services\Backend\CreditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherCardController extends Controller
{
    public function __construct(protected CreditService $creditService){}   
    
    public function index()
    {
        // Onaylı ilanların öğretmen ID'lerini al
        $teacherIds = TeacherAdvertisement::where('approved', 1)
        ->distinct('teacher_id')
        ->pluck('teacher_id');

        // Öğretmenler ve ilk onaylı ilanlarını al
        $teachers = User::whereIn('id', $teacherIds)
        ->with(['advertisements' => function($query) {
            $query->where('approved', 1)->first(); // Onaylı ilanın ilkini seç
        }])
        ->get();

        return view('teacher_cards.index', compact('teachers'));
    }
}
