<?php

namespace App\Http\Controllers\Backend\Lessons;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Lessons\LessonAddRequest;
use App\Models\Backend\Lesson;
use App\Models\Backend\TeacherToLessonAndClass;
use App\Models\User;
use App\Services\Backend\LessonService;
use App\Services\Backend\TeacherToLessonAndClassService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{

    public function __construct(
        protected LessonService $lessonService,
        protected TeacherToLessonAndClassService $teacherToLessonAndClassService,

        ){}
     
    public function index()
    {

        $index=$this->lessonService->getWithWhere();
        if (!empty($index)) {
            return view('filter_lesson.index',compact('index')); 
        }
    }
    public function addLessonList()
    {
        
        $id=Auth::user()->id;
        //dd($id);
        $adminData=User::find($id);
        $lessonData=$this->lessonService->getWithWhere();
        $lessonDataTrashed=$this->lessonService->getWithWhereOnlyTrashed();
        if (!empty($lessonData)) {
            return view('admin.add_lessons',compact('lessonData','lessonDataTrashed','adminData','id')); 
        }
    }

    public function create()
    {
        //
    }

    public function store(LessonAddRequest $request)
    {
        $store=$this->lessonService->create($request->all());
        if (!empty($store)) {
            toastr()->success('Ders Ekleme İşlemi Başarılı', 'Başarılı', ["positionClass" => "toast-top-right"]);
            return redirect()->back();   
        }
    }

    public function deleteLessons(Request $request){
        
        $data=$this->lessonService->delete($request->id);
        if (!empty ($data)){
            return redirect()->back();
        }

    }
public function restoreLessons(Request $request)
    {
        $data=$this->lessonService->restore($request->id);
        if (!empty ($data)){
            return redirect()->back();
        }
    }
    public function forceDeleteLessons(Request $request)
    {
        if(!$request->id)   
        {
            $lesson_id=0;
        } else
        {   
            $lesson_id=$request->id;
        }
        $data=$this->lessonService->forceDeleteLessons($lesson_id);
        //dd($data);
        if($data>0 && $data!='true'){
            toastr()->warning('Kullanımda olan ders/dersler silinemedi', 'Silinemeyen Dersler', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }elseif($data==0)
        {
            toastr()->success('Pasif Tüm dersler Tamamen silindi', 'Silindi', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }elseif($data=='true'){
            toastr()->success('Ders Tamamen Silindi', 'Silindi', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }elseif($data=='false'){
            
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
        $update=$this->lessonService->update($request->all(),$id);
        if (!empty($update)) {
            
        }
    }

    
    public function destroy(string $id)
    {
        //
    }
}
