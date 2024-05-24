<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Backend\LessonService;
use App\Services\Backend\ClassService;
use App\Services\Backend\TeacherDetailService;
use App\Services\Backend\TeacherGeneralService;
use App\Services\Backend\TeacherToLessonAndClassService;
use App\Services\Backend\TeacherToLocationService;
use Illuminate\Support\Facades\Auth;

class TeacherDetailsController extends Controller
{
    public function __construct(
        protected LessonService $lessonService,
        protected ClassService $classService,
        protected TeacherDetailService $teacherDetailService,
        protected TeacherGeneralService $teacherGeneralService,
        protected TeacherToLessonAndClassService $teacherToLessonAndClassService,
        protected TeacherToLocationService $teacherToLocationService
        ){}
    public function index(){ 
        $id = Auth::user()->id;
        $userData = User::find($id);
        $data=$this->teacherGeneralService->general();
        return view('users.user_profile',compact('data','userData'));
    }
    public function lessons(){
        $data=$this->teacherGeneralService->general();
        return view('teachers.teacher_lesson_info',compact('data'));
    } 
   
    public function info(){
        $data=$this->teacherGeneralService->general();
        
        return view('teachers.teacher_profile_info',compact('data'));
    } 
    
    public function front(){
        $data=$this->teacherGeneralService->general();
        return view('teachers.teacher_profile_front',compact('data')); 
    }
    public function deleteClasses($id){
        $data=$this->teacherToLessonAndClassService->deleteClasses($id);
        if (!empty ($data)){
            return redirect()->back();
        }

    }
    public function deleteLessons($id){
        $data=$this->teacherToLessonAndClassService->deleteLessons($id);
        if (!empty ($data)){
            return redirect()->back();
        }

    }
    public function deleteLocations($id){
        $data=$this->teacherToLocationService->deleteLocations($id);
        if (!empty ($data)){
            return redirect()->back();
        }

    }

     public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
       $id=1;
        $data=$this->teacherGeneralService->updateTeacherDetails($request->all(),$id);
        //return view('teachers.teacher_profile',compact('data'));
 
    }

    public function updateProfile(Request $request) : void
    {
       $id=1;
        $data=$this->teacherGeneralService->updateTeacherProfile($request->all(),$id);
        //return view('teachers.teacher_profile',compact('data'));

    }
    public function updateLessonClassLocation(Request $request)
    {
        //dd($request);
       $id=1;
        $data=$this->teacherGeneralService->updateTeacherLessonClassLocation($request->all(),$id);
        
        //return view('teachers.teacher_profile',compact('data'));
        if(!empty($data)){
            toastr()->success('Güncelleme İşlemi Başarılı', 'Başarılı', ["positionClass" => "toast-top-right"]);
            return back();
        }
     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
