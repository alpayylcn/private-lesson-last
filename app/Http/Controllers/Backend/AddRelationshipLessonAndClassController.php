<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AddLessonAndClasses\AddLessonAndClassesRequest;
use App\Models\User;
use App\Services\Backend\ClassService;
use App\Services\Backend\LessonService;
use App\Services\Backend\LessonToClassService;
use App\Services\Backend\TeacherGeneralService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddRelationshipLessonAndClassController extends Controller
{public function __construct(
    protected LessonToClassService $lessonToClassService,
    protected TeacherGeneralService $teacherGeneralService,
    protected LessonService $lessonService,
    protected ClassService $classService,
    ){}
    public function LessonsToClasses()
    {
        $id=Auth::user()->id;
        //dd($id);
        $adminData=User::find($id);
        $lessons=$this->lessonService->getWithWhere();
        $classes=$this->classService->getWithWhere();
        $lessonsData=$this->lessonToClassService->getWithWhereGroupLesson();
        $classesData=$this->lessonToClassService->getWithWhere();
        //dd($lessons);
        return view('admin.lessons_to_classes',compact('classes','lessons','lessonsData','classesData','id','adminData'));
        
    }
    public function updateOrCreate(AddLessonAndClassesRequest $request)
    {  
        //dd($request);
        foreach($request->class_id as $classId){
            
            $lesson_id=$request->lesson_id;
            $class_id=$classId;
            $updateOrCreate=$this->lessonToClassService->updateOrCreate(['class_id'=>$class_id],$lesson_id);
        }
        if (!empty($updateOrCreate)) {
            
            toastr()->success('İlişkilendirme İşlemi Başarılı', 'Başarılı', ["positionClass" => "toast-top-right"]);
            return redirect()->back();   
        }
    }
    public function adminLessonToClassesAjax(Request $request)
    {
        //dd($request);
        $selectedItems = $request->input('item_ids', []); //dd($selectedItems);
        $responseData=$this->lessonToClassService->adminLessonToClassesDeleteAjax($selectedItems);
        return response()->json(['message' => 'Seçili olmayan öğeler başarıyla silindi.']); 
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
