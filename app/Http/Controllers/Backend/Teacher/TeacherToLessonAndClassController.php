<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Services\Backend\TeacherToLessonAndClassService;
use Illuminate\Http\Request;

class TeacherToLessonAndClassController extends Controller
{   
    public function __construct(
    
    protected TeacherToLessonAndClassService $teacherToLessonAndClassService,
   
    ){}   
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
    public function updateorCreate(Request $request, string $id)
    {   
        
        $id=1;
        $data=$this->teacherToLessonAndClassService->updateOrCreate($request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
