<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Wallet\WalletRequest;
use App\Models\User;
use App\Services\Backend\CreditGiftService;
use App\Services\Backend\UserService;
use Illuminate\Http\Request;

class CreditGiftForTeacherController extends Controller
{
    public function __construct(
        protected CreditGiftService $creditGiftService,
        protected UserService $userService,
    ){}

    public function index(Request $request)
    {
        $search = $request->query('search');
        $teachers = $this->userService->getTeachers($search);//Rolü Teacher olan kullanıcıları getir
        $counts = $this->userService->countTeachers();
        
        return view('admin.credit_gift_for_teacher.index', [
            'teachers' => $teachers,
            'totalTeachers' => $counts['total'],
            'unapprovedTeachers' => $counts['unapproved'],
        ]);
  
    }
    public function addMoney(WalletRequest $request)
    {
        //dd($request);
        $this->creditGiftService->addMoney($request['teacher_id'], $request['amount']);

        return response()->json(['success' => 'Kredi başarıyla gönderildi.']);
    }

}
