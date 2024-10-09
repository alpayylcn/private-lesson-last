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
use App\Services\Backend\StepOptionTitleService;
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
        protected StepOptionTitleService $stepOptionTitleService,
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
        $userId=auth()->user()->id;
        
        $data=$this->stepQuestionService->getWithWhere();
        $stepCount=$this->stepQuestionService->getWithWhere();
        //dd($data->title);
        return view('admin.filter_items',compact('data','userId','stepCount'));
        
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
        $userId=auth()->user()->id;
        
        $data=$this->stepQuestionService->getWithWhere();
        //dd($data->title);
        return view('admin.filter_items_and_options',compact('data','userId'));
        
    }
    public function filterItemsAdd(StepQuestionAddRequest $request)
    {
        $userId = auth()->user()->id; // test et sil
        $lastRank = $this->stepQuestionService->lastRank(); //en büyük rank değerini alıyor(Son Soru)
        //son soru her zaman iletişim türü olsun istediğimiz için rank değerini bir arttırıyoruz ve satırı güncelliyoruz.
        $updateData = $this->stepQuestionService->first(['rank' => $lastRank]);
        $updateData->update(['rank' => $lastRank + 1]);
        if (!empty($updateData)) {
            $questionAdd = $this->stepQuestionService->create(['title' => $request->title, 'rank' => $lastRank]); //yeni satır ekleniyor
        }

        if (!empty($questionAdd)) {
            $stepOptionsTitle = $this->stepOptionTitleService->create(['question_id' => $questionAdd->id]);
            $data = $this->stepQuestionService->getWithWhere();//test et sil 
            toastr()->success('Ekleme İşlemi Başarılı', 'Başarılı', ["positionClass" => "toast-top-right"]);
            return back();
        }else{
            toastr()->warning('Ekleme İşlemi Başarsız', 'Başarısız', ["positionClass" => "toast-top-right"]);
            return back();
        }
       
        
    }
    public function filterItemsUpdate(StepQuestionRequest $request)
    {
        
        $userId=auth()->user()->id;
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
        if (!empty($request->id)) {
            $lastRank = $this->stepQuestionService->lastRank(); //en büyük rank değerini alıyor(Son Soru) sildikten sonra
            $updateData = $this->stepQuestionService->first(['rank' => $lastRank]);
            $data = $this->stepQuestionService->delete($request->id);
            if (!empty($data)) {
                $updateData->update(['rank' => $lastRank - 1]);
                $optionDelete=$this->stepOptionTitleService->deleteByQuestionId($request->id);
                return redirect()->back();
            }
        }
       
        
    }
    public function create()
    {
        
    }

    public function store(Request $request)
    {
       
    }

    public function show(string $id)
    {
       
    }

    
    public function edit(string $id)
    {
       
    }

    
    public function update(Request $request, string $id)
    {
       
    }

  
    public function destroy(string $id)
    {
        //
    }
}
