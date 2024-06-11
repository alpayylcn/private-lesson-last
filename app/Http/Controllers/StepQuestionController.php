<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStepOptionTitleRequest;
use App\Models\Backend\StepOptionTitle;
use App\Models\Backend\StepQuestion;
use App\Services\Backend\StepQuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StepQuestionController extends Controller
{ public function __construct(
   
    protected StepQuestionService $stepQuestionService, 
    
    ){}
    public function index()
    {
        $userId=Auth::user()->id;
        $stepQuestions = StepQuestion::all();
        return view('admin.step_question', compact('stepQuestions','userId'));
    }

    public function filterOptionsAdd(UpdateStepOptionTitleRequest $request)
    {   
        $optionAdd=StepOptionTitle::create($request->except('_token','user_id'));
            $optionAdd->update(['option_id'=>$optionAdd->id]); //tabloya create işlemi yapılınca option_id sütununa id bilgisini ekliyoruz
        if(!empty($optionAdd)){
            toastr()->success('Ekleme İşlemi Başarılı', 'Başarılı', ["positionClass" => "toast-top-right"]);
            return response()->json($optionAdd, 201);
        }  
    }

    public function filterOptionsDelete(Request $request)
    {   
        if(!empty($request->id))
        {
            $data=StepOptionTitle::find($request->id);
            $data->delete();
                if (!empty ($data)){
                    return redirect()->back();
                }
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
      // dd($request);
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
