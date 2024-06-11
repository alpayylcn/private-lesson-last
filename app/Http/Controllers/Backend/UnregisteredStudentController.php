<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UnregisteredStudents\UnregisteredStudentRequest;
use App\Models\Backend\TeacherAppointmentList;
use App\Services\Backend\StudentPrivateLessonSearchService;
use App\Services\Backend\TeacherAppointmentListService;
use App\Services\Backend\UnregisteredStudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use Symfony\Component\HttpKernel\Attribute\WithLogLevel;
use Symfony\Component\Routing\Loader\ProtectedPhpFileLoader;

class UnregisteredStudentController extends Controller
{
    
        public function __construct(
            protected UnregisteredStudentService $unregisteredStudentService,
            protected StudentPrivateLessonSearchService $studentPrivateLessonSearchService,
            protected TeacherAppointmentListService $teacherAppointmentListService
            ){}
    
    public function index()
    {
        $index=$this->unregisteredStudentService->getWithWhere(['id'=>1]);
        if(!empty ($index)){
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function contactForm($param)
    {   
        if(!empty($param)){
            $selectTeacherId=$param;
        }else{
            $selectTeacherId=0;
        }
        return view('filter_lesson.filter_lesson_search_student_contact_form',compact('selectTeacherId'));
    }
        public function contactFormCreate(UnregisteredStudentRequest $request)
    {   
        $store=$this->unregisteredStudentService->create($request->all());
       // dd($store->id);
        if(!empty ($store)){
            $teacherAppointmentListStore=$this->teacherAppointmentListService->create(['unregistered_student_id'=>$store->id,'teacher_id'=>$request->select_teacher_id]);
            $studentFilters= $this->studentPrivateLessonSearchService->getWithWhere(['session_id'=> session()->getId()]);
            return view('filter_lesson.filter_lesson_search_end',compact('studentFilters'));
        }else{
            toastr()->warning('Kayıt Yapılamadı', 'İşlem Hatası', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
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
    public function update(Request $request, string $id)
    {
        $update=$this->unregisteredStudentService->update($request->all(),$id);
        if (!empty ($update)){
            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroy=$this->unregisteredStudentService->delete($id);
        if (!empty ($destroy)){

        }
    }
}
