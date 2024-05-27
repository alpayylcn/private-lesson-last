<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StepQuestion\StepQuestionAddRequest;
use App\Http\Requests\Backend\StepQuestion\StepQuestionRequest;
use App\Models\Backend\StepOptionTitle;
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

    public function getStepOptionTitles($id)
    {
        $stepQuestion = StepQuestion::with('stepOptionTitles')->find($id);
        
        if (!$stepQuestion) {
            return response()->json(['message' => 'Step question not found'], 404);
        }
        
        return response()->json($stepQuestion->stepOptionTitles);
    
    }
    public function filterItemsOptions()
    {   
        $userId=Auth::user()->id;
        
        $data=$this->stepQuestionService->getWithWhere();
        //dd($data->title);
        return view('admin.filter_items_and_options',compact('data','userId'));
        
    }
    public function filterItemsAdd(StepQuestionAddRequest $request)
    {   
       //dd('soru ekleme',$request);
        $userId=Auth::user()->id;
       
        $questionAdd=$this->stepQuestionService->create($request->except('_token'));
       // dd($questionAdd->id);
        
        if(!empty($questionAdd)){
            $stepOptionsTitle=StepOptionTitle::create(['question_id'=>$questionAdd->id]);
           $data=$this->stepQuestionService->getWithWhere();
        //dd($data->title);
        toastr()->success('Ekleme İşlemi Başarılı', 'Başarılı', ["positionClass" => "toast-top-right"]);
        return back();  
        }
       
        
    }
    public function filterItemsUpdate(StepQuestionRequest $request)
    {//dd($request);
        $userId=Auth::user()->id;
        foreach ($request->rank as $id => $rank) 
        {
           
            $updateQuestion=StepQuestion::where('id', $id)->update([
                
                'rank'=>$rank,
                'title'=>$request->title[$id],
                ]); 
            
        }
        $data=$this->stepQuestionService->getWithWhere();
        toastr()->success('Güncelleme İşlemi Başarılı', 'Başarılı', ["positionClass" => "toast-top-right"]);
        return back();
        
    }
    public function filterItemsDelete(Request $request)
    {   
        if(!empty($request->id))
        {
            $data=$this->stepQuestionService->delete($request->id);
                if (!empty ($data)){
                    $optionDelete=StepOptionTitle::where('question_id',$request->id)->delete();
                    return redirect()->back();
                }
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
