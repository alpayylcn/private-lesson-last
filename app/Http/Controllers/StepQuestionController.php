<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStepOptionTitleRequest;
use App\Models\Backend\StepOptionTitle;
use App\Models\Backend\StepQuestion;
use App\Services\Backend\FilterLessonLocationService;
use App\Services\Backend\StepOptionTitleService;
use App\Services\Backend\StepQuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StepQuestionController extends Controller
{ public function __construct(
   
    protected StepQuestionService $stepQuestionService, 
    protected FilterLessonLocationService $filterLessonLocationService,
    protected StepOptionTitleService $stepOptionTitleService
    
    ){}
    public function index()
    {
        $userId=Auth::user()->id;
        $stepQuestions = StepQuestion::all();
        return view('admin.step_question', compact('stepQuestions','userId'));
    }

    public function filterOptionsAdd(UpdateStepOptionTitleRequest $request)
    {   
        $requestData = $request->except('_token');
        $optionData = $request->except('_token', 'user_id');
    
        // Eğer gelen bilgi 3. soruya aitse (ders nerede yapılacak?) önce lokasyon tablosuna ekleme yapıyoruz
        if($request->question_id == 3)  {
            // `user_id`'yi `add_user_id` olarak ayarlıyoruz
            $requestData['add_user_id'] = $request->user_id;
            
            // Lokasyon tablosuna kaydı ekliyoruz
            $locationAdd = $this->filterLessonLocationService->create($requestData);
            
            // Eğer lokasyon eklenmişse, lokasyonun ID'sini alıp `optionData`'ya ekliyoruz
            if ($locationAdd) {
                $optionData['option_id'] = $locationAdd->id;
            }
        }  
    
        // Opsiyonları `step_option_title` tablosuna ekliyoruz
        $optionAdd = $this->stepOptionTitleService->create($optionData);
        
        // Eğer `option_id` eklenmediyse, kaydedilen opsiyonun kendi ID'sini kullanarak `option_id`'yi güncelliyoruz
        if ($request->question_id != 3) {
            $option_id = $optionAdd->id;
            $optionAdd->update(['option_id' => $option_id]);
        }
        
        // İşlem başarılı olursa geri bildirim veriyoruz
        if (!empty($optionAdd)) {
            toastr()->success('Ekleme İşlemi Başarılı', 'Başarılı', ["positionClass" => "toast-top-right"]);
            return response()->json($optionAdd, 201);
        }
    }

    public function filterOptionsDelete(Request $request)
    {   
        if(!empty($request->id) )
        {
            if($request->questionId==3){//Eğer 3 soruya ait silme işlemi varsa lokasyon tablosundan da silinecek
                $locationId=$this->stepOptionTitleService->getWithWhere(['id'=>$request->id,'question_id'=>3])->first()->option_id;
                $deleteLocation=$this->filterLessonLocationService->delete($locationId);
           }
            if($deleteLocation){
                $data=$this->stepOptionTitleService->delete($request->id);
            }
            
           
            
        }
        if (!empty ($data)){
                 return redirect()->back();
        }
        
    }
    public function getStepOptionTitles($id)
    {
        $stepQuestion = StepQuestion::with('stepOptionTitle')->find($id);
        
        if (!$stepQuestion) {
            return response()->json(['message' => 'Step question not found'], 404);
        }
        
        return response()->json($stepQuestion->stepOptionTitle);
    }

    public function filterOptionsUpdate(Request $request)
    { 
      //dd($request);
            foreach($request->option_title as $key => $title)
                {
                   $updateOption=StepOptionTitle::where('id', $key)->update([
                    'question_id'=>$request->question_id,
                    'title'=>$title,
                    'teacher_title'=>$request->option_teacher_title[$key],
                    ]);   
                }
            if(!empty($updateOption)){
                toastr()->success('Güncelleme İşlemi Başarılı', 'Başarılı', ["positionClass" => "toast-top-right"]);
                return back();
            }    
                
       
        
    }
}
