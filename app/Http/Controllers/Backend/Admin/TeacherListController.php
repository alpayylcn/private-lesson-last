<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backend\TeacherDetail;
use App\Models\User;
use App\Models\UserDetail;
use App\Services\Backend\UserService;
use Illuminate\Http\Request;

class TeacherListController extends Controller

{

    public function __construct(
        protected UserService $userService,
        
    ){}
    public function index(Request $request)
    {
        
        $search = $request->query('search');
        $teachers = $this->userService->getTeachers($search);//Rolü Teacher olan kullanıcıları getir
        $counts = $this->userService->countTeachers();

        return view('admin.teacher_list.index', [
            'teachers' => $teachers,
            'totalTeachers' => $counts['total'],
            'unapprovedTeachers' => $counts['unapproved'],
        ]);


        
    }

    public function approve(Request $request)
    {

        $userId = $request->input('id');
        $approved = $request->input('approved');
        
        $user = $this->userService->approveUser($userId, $approved);

        if ($user) {
            return response()->json(['success' => true]);
        }

            return response()->json(['success' => false],400);

    }
}
