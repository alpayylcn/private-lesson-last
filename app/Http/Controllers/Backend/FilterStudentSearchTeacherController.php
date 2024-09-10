<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFilterStudentSearchTeacherRequest;
use App\Services\Backend\LessonRequestService;
use Illuminate\Http\Request;
use App\Services\Backend\LessonService;
use App\Services\Backend\StepQuestionService;
use App\Services\Backend\StepOptionTitleService;
use App\Services\Backend\StudentPrivateLessonSearchService;
use App\Services\Backend\TeacherAppointmentListService;
use App\Support\Helper;
use Illuminate\Support\Facades\Session as FacadesSession;

class FilterStudentSearchTeacherController extends Controller
{
    public function __construct(
        protected LessonService $lessonService, 
        protected StepQuestionService $stepQuestionService, 
        protected StepOptionTitleService $stepOptionTitleService,
        protected StudentPrivateLessonSearchService $studentPrivateLessonSearchService,
        protected TeacherAppointmentListService $teacherAppointmentListService,
        protected LessonRequestService $lessonRequestService,
        ){}
    public function index()
    {
        $stepCount = $this->stepQuestionService->getWithWhere();

        //step_question tablosundan 1. sıradaki soruyu seçer. ve o soruya ait bilgileri getirir.
        $stepNumber = $this->stepQuestionService->first(['rank' => 1]);
        if (!empty($stepNumber) && $stepNumber->rank == 1) {
            //stepNumber değeri boş dönmediyse oradan gelen soru id sini alarak bu soruya ait optionları getirir.
            // stepNumber ->rank 1 ise lesson tablosundan dersleri çekecek
            //1 numaralı soru kesinlikle "Hangi Dersten Özel Ders İstiyorsunuz" olmalı
            $stepOption = $this->lessonService->getWithWhere();
        } elseif (!empty($stepNumber) && $stepNumber->rank != 1) {
            $stepOption = $this->stepOptionTitleService->getWithWhere(['question_id' => $stepNumber->id]);
        }
        //blade de karışıklık olmasın diye burada değişkenleri bir diziye aktarıyoruz 
        $filterStepData = ['stepOption'=>$stepOption,'stepNumber'=> $stepNumber];
         
        return view('filter_lesson.index', compact('filterStepData', 'stepCount')); 
    }

    public function stepCreate(StoreFilterStudentSearchTeacherRequest $request)
    {
        $stepCount = $this->stepQuestionService->getWithWhere(); //kaç adet kayıt olduğunu soruyoruz
        //Filtreleme sayfasından gelen veriler güncellenmek için servise gönderiliyor.
        $updateOrCreate = $this->studentPrivateLessonSearchService->updateOrCreateLessonSearch($request->all());

        if (!empty($updateOrCreate) && $request->question_rank != $stepCount->count()) { //Servisten dönen değer (Güncelleme başarılı ise)
            //filtreleme işleminde son adıma gelmediyse create işlemi devam etsin
            $filterStepData = $this->studentPrivateLessonSearchService->lessonSearchFilters($request->all());
           
            return view('filter_lesson.index', compact('filterStepData', 'stepCount'));
        } elseif (!empty($updateOrCreate) && $request->question_rank == $stepCount->count()  ) {
            
            $typeData=$this->stepOptionTitleService->first(['question_id'=>$request->question_id,'option_id'=>$request->option_value]);
            if($typeData->title=="Öğretmen Beni Arasın"){
               return $this->searchEnd($request);
            }else{//Öğretmeni ben seçeceğim
                return redirect()->route('teacher_cards.chooseTheTeacher');
                // $teacherListData = $this->studentPrivateLessonSearchService->lessonSearchFiltersTeacherList($request->all());
                // return view('filter_lesson.filter_teacher_list', compact('teacherListData'));
            }
        }else{
            toastr()->warning('Güncelleme Yapılamadı', 'İşlem Hatası', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }
    public function searchEnd(Request $request)
    {
        if (auth()->user()) { // Öğrenci kayıtlı ise
           $studentFilters = $this->studentPrivateLessonSearchService->getWithWhere(['session_id' => session()->getId()]);
            if (!empty($request->select_teacher_id)) { // Öğretmen listeden seçildi ise "Öğretmeni ben seçeceğim"
                
                $selectTeacherId = $request->select_teacher_id;
                $teacherAppointmentListStore = $this->teacherAppointmentListService->create(['student_id' => auth()->user()->id, 'teacher_id' => $request->select_teacher_id]);
            }else{//Öğretmen beni arasın
                // Filtrelenmiş verilerden question_id'si 1 (Hangi Ders? sorusu) olan satırı çek 
                $lessonData = $studentFilters->firstWhere('step_question_id', 1);
                //İlgili öğretmenlere ders talebi gönder.
                $result = $this->lessonRequestService->requestLesson($lessonData->step_option_id);
            }
            return redirect()->route('lesson_request_list.index');
            //return view('filter_lesson.filter_lesson_search_end', compact('studentFilters'));

        } else { 
            if (!empty($request->select_teacher_id)) {
                $selectTeacherId = $request->select_teacher_id;
            } else {
                $selectTeacherId = 0;
            }
            return redirect()->route('all_step_filter.contactForm', ['param' => $selectTeacherId]);
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
