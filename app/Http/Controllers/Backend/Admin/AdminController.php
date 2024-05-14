<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Services\Backend\ClassService;
use App\Services\Backend\LessonService;
use App\Services\Backend\StepOptionService;
use App\Services\Backend\StepQuestionService;
use App\Services\Backend\TeacherGeneralService;
use Egulias\EmailValidator\Result\Reason\EmptyReason;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(
        
        protected TeacherGeneralService $teacherGeneralService,
        protected StepOptionService $stepOptionService,
        protected StepQuestionService $stepQuestionService,
        protected LessonService $lessonService,
        protected ClassService $classService,
        
        ){}
    public function index()
    {
        //dd('index');
        return view('admin.index');
        
    }

   
    public function addClasses()
    {
        $classData=$this->classService->getWithWhere();
        return view('admin.add_classes',compact('classData'));
        
    }
   
  
    public function addClassesCreate(Request $request)
    {   
            $data=$this->classService->create($request->all());
        
        return back();
        
    }
    
    public function filterItems()
    {
        $data=$this->stepQuestionService->getWithWhere();
        //dd($data->title);
        return view('admin.filter_items',compact('data'));
        
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
