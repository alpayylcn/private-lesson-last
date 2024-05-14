<?php

namespace App\Http\Controllers\Backend\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Backend\LessonService;
use App\Services\Backend\ClassService;
use App\Services\Backend\TeacherDetailService;
use App\Services\Backend\TeacherGeneralService;
use App\Services\Backend\TeacherToLessonAndClassService;
use App\Services\Backend\TeacherToLessonPriceService;
use App\Services\Backend\TeacherToLocationService;

class TeacherToLessonPriceController extends Controller
{
    public function __construct(
        protected LessonService $lessonService,
        protected ClassService $classService,
        protected TeacherDetailService $teacherDetailService,
        protected TeacherGeneralService $teacherGeneralService,
        protected TeacherToLessonAndClassService $teacherToLessonAndClassService,
        protected TeacherToLocationService $teacherToLocationService,
        protected TeacherToLessonPriceService $teacherToLessonPriceService
    ){}

    public function LessonPrice(){
       
        $data=$this->teacherToLessonPriceService->listTeacherLessonPrice();
        //dd($data);
        return view('teachers.teacher_lesson_price',compact('data'));
    } 
    public function lessonToPriceUpdate(Request $request)
    {
        $id=1;
        $data= $this->teacherToLessonPriceService->updateTeacherLessonPrice($request->all(),$id);
        if(!empty($data)){
            toastr()->success('Güncelleme İşlemi Başarılı', 'Başarılı', ["positionClass" => "toast-top-right"]);
         return back();
        }
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
