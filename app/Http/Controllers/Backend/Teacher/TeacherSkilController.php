<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Services\Backend\TeacherSkilService;
use App\Services\Backend\TeacherToLessonAndClassService;
use Illuminate\Http\Request;

class TeacherSkilController extends Controller 
{
    public function __construct(
        protected TeacherSkilService $teacherSkilService,
        protected TeacherToLessonAndClassService $teacherToLessonAndClassService,

        ){}
    public function index()
    {
        //
    }

    public function lessonToClassesAjax(Request $request)
    {
        //dd($request);
        $id=1;
        $html='';
        $teacherToClass=$this->teacherToLessonAndClassService->getWithWhereClass(['user_id'=>$id]);
        //dd($teacherToClass);
        $responseData=$this->teacherSkilService->lessonToClassesAjax($request->except('_token'));
       //dd($responseData);
        if (!empty ($responseData)){
            foreach($responseData as $cid=> $title){
                $html .=
               '<div class="form-check checkbox payment-radio mb-2"> 
                <input class="form-check-input" name="class_id['.$cid.']" type="checkbox"
                ';
                ; foreach ($teacherToClass as $classes){ 
                    if ($classes->class_id == $cid){
                        $html.='checked';
                    }
                }
                
                $html.='
                id="inlineCheckbox1" value="'.$cid.'" />
                <label class="form-check-label" for="inlineCheckbox1">' .$title. '</label>
                </div>
                ';
            
            }
        }
        else{
            $html .=
                '
                <div class="form-check checkbox payment-radio mb-2">
                <label class="form-check-label" for="inlineCheckbox1">LÜTFEN BRANŞ SEÇİMİNİZİ KONTROL EDİNİZ</label>
                </div>
                ';
        }
       return $html;
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
