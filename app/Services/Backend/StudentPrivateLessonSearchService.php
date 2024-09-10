<?php
namespace App\Services\Backend;
use App\Models\Backend\StudentFilter;
use App\Models\StudentPrivateLessonSearch;
use App\Support\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;
class StudentPrivateLessonSearchService{

       
    public function __construct(
        protected StudentPrivateLessonSearch $studentPrivateLessonSearch,
        protected LessonService $lessonService, 
        protected StepQuestionService $stepQuestionService, 
        protected StepOptionService $stepOptionService, 
        protected FilterAllStepService $filterAllStepService,
        protected LessonToClassService $lessonToClassService,
        protected StudentFilterService $studentFilterService,
        protected TeacherDetailService $teacherDetailService,
        protected TeacherToLessonAndClassService $teacherToLessonAndClassService,
        protected StepOptionTitleService $stepOptionTitleService,
        
        ){}
        
          
    public function studentChooseLesson (int $studedntId){
        return StudentPrivateLessonSearch::where('step_question_id', 1)->where('student_id',$studedntId)->first()->step_option_id;
    }   
    public function studentChooseClass (int $studedntId){
        return StudentPrivateLessonSearch::where('step_question_id', 2)->where('student_id',$studedntId)->first()->step_option_id;
    } 
    public function lessonSearchFilters(array $data){
        
        $stepNumber=$this->stepQuestionService->whereRank($data['question_rank']);
        
        //$stepNumber verisi geliyorsa ve bir sonraki soru 2 yani "hangi sınıf" sorusu ise işlem yap
        if(!empty($stepNumber) && $stepNumber->rank==2){
            $stepOption= $this->lessonToClassService->getWithWhere(['lesson_id'=>$data['option_value']]);
            
        }
        //$stepNumber verisi geliyorsa ve bir sonraki soru 2 yani "hangi sınıf" sorusu "değil" ise işlem yap
        elseif (!empty($stepNumber) && $stepNumber->rank!=2) { 
            
            //$stepNumber dan gelen soru id(question_id) sine göre option ları getirir.
            $stepOption= $this->stepOptionTitleService->getWithWhere(['question_id'=>$stepNumber->id]);
            
        }
        
        return ['stepNumber'=>$stepNumber,'stepOption'=>$stepOption];
    }

    public function lessonSearchFiltersTeacherList(array $data){
         
        $sessionId = FacadesSession::getId();
        $studentFilters= $this->getWithWhere(['session_id'=>$sessionId]);//session id si aynı olan bütün kayıtları listele
       // dd($studentFilters);
        $lesson_id=$studentFilters->firstWhere('step_question_id', 1);// step_question_id 1 olanı bul 
        $class_id=$studentFilters->firstWhere('step_question_id', 2);// tep_question_id 2 olanı bul
       
        $teachersData=$this->teacherToLessonAndClassService->getWithWhere( 
            [
            'lesson_id'=>$lesson_id->step_option_id
            ])->where('class_id',$class_id->step_option_id);//üst satırdan gelen lesson_id ve class_id değerlerine uygun öğretmenleri getir.
            //dd($teachersData);            
            if (auth()->user()){
                $user_id=auth()->user()->id;
                $userUpdate = StudentPrivateLessonSearch::where('session_id',$sessionId)
                ->update(
                    ['student_id'=>$user_id]
                );
            }
            return ['studentFilters'=>$studentFilters,'teachersData'=>$teachersData];
    }
    public function create(array $studentPrivateLessonSearchData){
        //dd($studentPrivateLessonSearchData);
        return $this->studentPrivateLessonSearch->create($studentPrivateLessonSearchData);
        
    }

    public function update(array $studentPrivateLessonSearchData,int $id=0){
        //dd('update service',$studentPrivateLessonSearchData,$id);
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->update($studentPrivateLessonSearchData);
        }
            return false;
        
    }
    public function updateOrCreateLessonSearch(array $data){
        if (auth()->user()){
            $user_id=auth()->user()->id;
            $statu_type=1;//veritabanına öğrencini kayıtlı olduğu bilgisi yazılacak "statu_type alanına"
        }else{
            $user_id=0;
            $statu_type=0;//veritabanına öğrencini kayıtlı olmadığı bilgisi yazılacak "statu_type alanına"
        }
        $clientIpAddress=Helper::getIp(); 
        $sessionId = session()->getId();//edge de test edilecek
        
        //blade den option value, question_id ve question_rank değeri geldi ise işlem yap.
        if(!empty($data['option_value']) && ($data['question_id']) && ($data['question_rank'])){
          
            $updateOrCreate = StudentPrivateLessonSearch::updateOrCreate(
                    ['session_id'=>$sessionId, 'step_question_id'=>$data['question_id']],
                    ['student_ip'=>$clientIpAddress,'step_option_id'=>$data['option_value'],'student_id'=>$user_id,'statu_type'=>$statu_type]
                );
                return $updateOrCreate;
            }
            
        return false;
        
    }
    public function updateOrCreate(array $studentPrivateLessonSearchData,string $sessionId){
        
        if($sessionId){
            return $this->studentPrivateLessonSearch->updateOrCreate(
            
                ['session_id' => $sessionId],
                [$studentPrivateLessonSearchData]
            );

        }
            return false;
        
    }
    

    public function delete(int $id){

            $first=$this->first(['id'=>$id]);
            return $first->delete();
    }

    public function getWithWhere(array $where = [])
   {
       // Veritabanı sorgusu oluştur
       $query = $this->studentPrivateLessonSearch->query();

       // 'where' koşullarını eklemek için dizi içinde gelen koşulları döngüye al
       if(is_array($where))
       {
           foreach ($where as $column => $value)
           {
               $query->where($column, $value);
           }
       }
       return $query->orderBy('id')->get();
    }

    public function first(array $where)
   {
         // Veritabanı sorgusu oluştur
         $query = $this->studentPrivateLessonSearch->query();

         // 'where' koşullarını eklemek için dizi içinde gelen koşulları döngüye al
         if(is_array($where))
         {
             foreach ($where as $column => $value)
             {
                 $query->where($column, $value);
             }
         }
         return $query->orderByDesc('id')->first();
         // Sayfalama işlemini yapmak için model
        }
        public function find(){

        }
        public function pagination(){

            
        }
    }