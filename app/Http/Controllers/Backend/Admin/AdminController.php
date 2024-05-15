<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StepQuestion\StepQuestionAddRequest;
use App\Http\Requests\Backend\StepQuestion\StepQuestionRequest;
use App\Models\Backend\StepQuestion;
use App\Services\Backend\ClassService;
use App\Services\Backend\LessonService;
use App\Services\Backend\StepOptionService;
use App\Services\Backend\StepQuestionService;
use App\Services\Backend\TeacherGeneralService;
use Egulias\EmailValidator\Result\Reason\EmptyReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $userId=Auth::user()->id;
       
        $data=$this->stepQuestionService->getWithWhere();
        //dd($data->title);
        return view('admin.filter_items',compact('data','userId'));
        
    }
    public function filterItemsAdd(StepQuestionAddRequest $request)
    {   
       // dd('soru ekleme',$request);
        $userId=Auth::user()->id;
       
        $questionAdd=$this->stepQuestionService->create($request->except('_token'));
        if(!empty($questionAdd)){
           $data=$this->stepQuestionService->getWithWhere();
        //dd($data->title);
        toastr()->success('Ekleme İşlemi Başarılı', 'Başarılı', ["positionClass" => "toast-top-right"]);
        return back();  
        }
       
        
    }
    public function filterItemsUpdate(StepQuestionRequest $request)
    {
        $userId=Auth::user()->id;
        foreach ($request->title as $id => $rank) 
        {
            // ID'ye göre modeli bul
            
            $model = StepQuestion::find($id);
            //dd($model);
            // Eğer model bulunursa ve rank değeri farklıysa güncelle
            if ($model && $model->rank != $rank) {
                $model->rank = $rank;
                $model->save(); // Güncelleme işlemi
            }  
        }
        $data=$this->stepQuestionService->getWithWhere();
        toastr()->success('Güncelleme İşlemi Başarılı', 'Başarılı', ["positionClass" => "toast-top-right"]);
        return back();
        
    }
    public function filterItemsDelete(Request $request)
    {   dd('$request');
        $userId=Auth::user()->id;
       
        $data=$this->stepQuestionService->getWithWhere();
        //dd($data->title);
        return view('admin.filter_items',compact('data','userId'));
        
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
