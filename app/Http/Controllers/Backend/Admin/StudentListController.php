<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Services\Backend\UserService;
use Illuminate\Http\Request;

class StudentListController extends Controller
{
    public function __construct(
        protected UserService $userService,
        
    ){}

    public function index(Request $request)
    {
        $search = $request->query('search');
        $students = $this->userService->getStudents($search);
        $counts = $this->userService->countStudents();

        return view('admin.student_list.index', [
            'students' => $students,
            'totalStudents' => $counts['total'],
            'unapprovedStudents' => $counts['unapproved'],
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
