<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\FilterAllStep;
use App\Models\Backend\StepQuestion;
use App\Models\Backend\TeacherDetail;
use App\Support\Helper;
use Illuminate\Http\Request;
use App\Services\Backend\LessonService;
use App\Services\Backend\StudentFilterService;
use App\Services\Backend\StepQuestionService;
use App\Services\Backend\FilterAllStepService;
use App\Services\Backend\LessonToClassService;
use App\Services\Backend\StepOptionService;
use App\Services\Backend\TeacherDetailService;
use App\Services\Backend\TeacherToLessonAndClassService;

class FilterStudentSearchTeacherController extends Controller
{
    public function __construct(
        protected LessonService $lessonService, 
        protected StepQuestionService $stepQuestionService, 
        protected StepOptionService $stepOptionService, 
        protected FilterAllStepService $filterAllStepService,
        protected LessonToClassService $lessonToClassService,
        protected StudentFilterService $studentFilterService,
        protected TeacherDetailService $teacherDetailService,
        protected TeacherToLessonAndClassService $teacherToLessonAndClassService
        ){}
    public function index(Request $request)
    {
        //step_question tablosundan 1. sıradaki soruyu seçer. ve o soruya ait bilgileri getirir.
        $stepNumber=$this->stepQuestionService->first(['rank'=>1]);
        if (!empty($stepNumber)) {
            //step_one değeri boş dönmediyse oradan gelen soru id sini alarak bu soruya ait optionları getirir.
            $stepOption= $this->stepOptionService->getWithWhere(['question_id'=>$stepNumber->id]);
            return view('filter_lesson.index',compact('stepNumber','stepOption')); 
        }
    }

    public function stepCreate(Request $request)
    {
       // $clientIpAddress = $request->getClientIp();
        $clientIpAddress=Helper::getIp();
       //dd($clientIpAddress);
        //blade den option value, question_id ve question_rank değeri geldi ise işlem yap.
        if(!empty($request->option_value) && ($request->question_id) && ($request->question_rank)){
          
            //gelen soru numarasına göre option servisten kayıt yapılacak alan bilgisini çekiyoruz.(lesson_id,class_id)
            $option_db_field=$this->stepOptionService->first(['question_id'=>$request->question_id]);
            if(!empty($option_db_field)){
                //gelen option_value değerini  veritabanına ekliyoruz.
                $create=$this->studentFilterService->create([$option_db_field->option_db_field=>$request->option_value,'student_ip'=>$clientIpAddress]);
            }
            //bir sonraki adımda update yapabilmek için blade e create edilen satırın id sini gönderiyoruz.
            if(!empty($create)){
                $createId=$create->id;
                //step_question tablosundan bir sonraki soruyu bul.
                $stepNumber=$this->stepQuestionService->whereRank($request->question_rank);
                    //$stepNumber verisi geliyorsa işlem yap
                    if(!empty($stepNumber && $option_db_field->option_db_field=='lesson_id')){
                        $stepOption= $this->lessonToClassService->getWithWhere(['lesson_id'=>$request->option_value]);
                        //dd($stepOption);
                        if (!empty($stepOption)) {
                            return view('filter_lesson.index',compact('stepNumber','stepOption','createId')); 
                       }

                    }

                    elseif (!empty($stepNumber)) {
                        //$stepNumber dan gelen soru id(question_id) sine göre option ları getirir.
                        $stepOption= $this->stepOptionService->getWithWhere(['question_id'=>$stepNumber->id]);
                        //dd($stepOption);
                        if (!empty($stepOption)) {
                             return view('filter_lesson.index',compact('stepNumber','stepOption','createId')); 
                        }
                    }         
            }   
        }
    }

    public function stepUpdate(request $request){ //dd($request->option_value,$request->question_id,$request->question_rank,$request->create_id);
        if(!empty($request->option_value) && ($request->question_id) && ($request->question_rank) && ($request->create_id)){
            //gelen soru numarasına göre option servisten kayıt yapılacak alan bilgisini çekiyoruz.(lesson_id,class_id)
            $option_db_field=$this->stepOptionService->first(['question_id'=>$request->question_id]);
            $createId=$request->create_id;
            if(!empty($option_db_field)){//step Question tablosundan gelen soruya ait option_db_field-> student filter tablosunda requestden gelen optionun kaydedileceği alan bilgisi
                $id=$request->create_id;//gelen veriyi update etmek için create id si değişkene atılır.
                //gelen option_value değerini veritabanına ekliyoruz.
                $update=$this->studentFilterService->update([$option_db_field->option_db_field=>$request->option_value],$id);
            }
            //bir sonraki adımda update yapabilmek için blade e create edilen satırın id sini gönderiyoruz.
            if(!empty($update)){ //update işlemi gerçekleşti ise...
                //step_question tablosundan bir sonraki soruyu bul.
                $stepNumber=$this->stepQuestionService->whereRank($request->question_rank);
                    
                    //Bu adım öğretmen listeleme adımı.. (requestten gelen option_db_field bilgisi filter_type_id ise)
                    //Eğer öğretmen beni arasın seçilirse öğrenciden iletişim bilgileri alınıp
                    //bilgiler uygun öğretmenlere gönderilecek.
                    if ($option_db_field->option_db_field == 'filter_type_id') {
                        if($request->option_value==1){
                            //dd('option',$request->option_value, 'öğretmen beni arasın');
                            return view('filter_lesson.filter_student_info');
                        }
                        //Bu adım öğretmen listeleme adımı.. Eğer öğretmeni ben seçeceğim seçilirse öğrenciden uygun öğretmenler listelenir.
                        elseif($request->option_value==2){
                            //dd('option',$request->option_value, 'öğretmeni ben seçeceğim');
                            $studentFilters= $this->studentFilterService->getWithWhere(['id'=>$createId])->first();
                            //dd($studentFilters->id);
                            if($studentFilters->filter_lesson_location_id==1){//online ise 
                                //burada öğrencinin seçtiği ders ve sınıfa göre öğretmenler listelenir.
                                $teachersData=$this->teacherToLessonAndClassService->getWithWhere(['teacher_lesson_location_id'=>1,'teacher_lesson_id'=>$studentFilters->lesson_id,'teacher_class_id'=>$studentFilters->class_id]);
                            
                            }  
                            else{//online değil ise
                                //burada öğrencinin seçtiği ders ve sınıfa göre öğretmenler listelenir.
                                $teachersData=$this->teacherToLessonAndClassService->getWithWhere(['teacher_lesson_location_id'=>2,'teacher_lesson_id'=>$studentFilters->lesson_id,'teacher_class_id'=>$studentFilters->class_id]);
                                
                            }       
                            return view('filter_lesson.filter_teacher_list',compact('studentFilters','teachersData'));
                        }
                    } 
                    elseif(!empty($stepNumber && $option_db_field->option_db_field=='lesson_id')){
                        $stepOption= $this->lessonToClassService->getWithWhere(['lesson_id'=>$request->option_value]);
                        //dd($stepOption);
                        if (!empty($stepOption)) {
                            return view('filter_lesson.index',compact('stepNumber','stepOption','createId')); 
                       }

                    }
                    //Eğer requestten gelen option_db_field bilgisi filter_type_id ve lesson_id değil ise sorulara devam et...  
                    elseif (!empty($stepNumber)) {
                        
                        //$stepNumber dan gelen soru id(question_id) sine göre option ları getirir.
                        $stepOption= $this->stepOptionService->getWithWhere(['question_id'=>$stepNumber->id]);
                        //dd($stepOption);
                        if (!empty($stepOption)) {
                             return view('filter_lesson.index',compact('stepNumber','stepOption','createId')); 
                        }
                    }         
            }   
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
