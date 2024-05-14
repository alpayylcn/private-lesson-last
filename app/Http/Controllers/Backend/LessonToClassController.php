<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Backend\ClassService;
use App\Services\Backend\LessonService;
use App\Services\Backend\LessonToClassService;
use App\Services\Backend\TeacherGeneralService;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\LessThan;

class LessonToClassController extends Controller
{
   
    public function __construct(
        protected LessonToClassService $lessonToClassService,
        protected TeacherGeneralService $teacherGeneralService,
        protected LessonService $lessonService,
        protected ClassService $classService,
        ){}
    
    public function index()
    {
        $index=$this->lessonToClassService->getWithWhere(['id'=>1]); 
        if (!empty($index)) {
            
        }
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
        $store=$this->lessonToClassService->create($request->all());
        if(!empty ($store)){


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
        $update=$this->lessonToClassService->update($request->all(),$id);
        if (!empty ($update)){
            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroy=$this->lessonToClassService->delete($id);
        if (!empty ($destroy)){

        }
    }
}
