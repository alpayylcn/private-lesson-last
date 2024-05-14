<?php
namespace App\Services\Backend;
use App\Models\Backend\TeacherSkil;
use App\Models\Backend\TeacherToLessonPrice;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class TeacherToLessonPriceService{

    public function __construct(
        protected TeacherSkil $teacherSkil,
        protected LessonToClassService $lessonToClassService,
        protected LessonService $lessonService,
        protected TeacherToLessonPrice $teacherToLessonPrice,
        protected TeacherToLessonAndClassService $teacherToLessonAndClassService,
    
    ){} 
    
    public function listTeacherLessonPrice(){
    $id=1;
    $lessonPrice=$this->getWithWhere(['user_id'=>$id]);
    $teacherToLesson=$this->teacherToLessonAndClassService->getWithWhereLesson(['user_id'=>$id]); 
    return compact('lessonPrice','teacherToLesson');
    }
    
   
    public function create(array $teacherToLessonPriceData){

        return $this->teacherToLessonPrice->create($teacherToLessonPriceData);
        
    }
    
    public function updateTeacherLessonPrice(array $teacherToLessonPriceData,int $id=0){
        
        foreach($teacherToLessonPriceData['lesson_id'] as $lesson){
            //echo $teacherToLessonPriceData['lesson_id'][$lesson];
             //dd('Serviste',$id,$teacherToLessonPriceData['lesson_id'][$lesson],$teacherToLessonPriceData['lesson_minute'][$lesson]);
            $updateLessonPrice=$this->teacherToLessonPrice->updateOrCreate(
                ['user_id'=>$id,'lesson_id'=>$teacherToLessonPriceData['lesson_id'][$lesson]],
                [
                'lesson_minute'=>$teacherToLessonPriceData['lesson_minute'][$lesson],
                'lesson_face_price'=>$teacherToLessonPriceData['lesson_face_price'][$lesson],
                'lesson_online_price'=>$teacherToLessonPriceData['lesson_online_price'][$lesson]
                ]
            );
         }
         return $updateLessonPrice; 
    }

    public function update(array $teacherToLessonPriceData,int $id=0){
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->update($teacherToLessonPriceData);
        }
            return false;
        
    }
    public function updateVisible(array $teacherToLessonPriceData,int $id=0){
        if($id!=0){
            return TeacherToLessonPrice::where('user_id',$id)->update($teacherToLessonPriceData);
        }
            return false;
        
    }

    public function updateOrCreate(array $teacherToLessonPriceData,int $id=0){
       // dd('servis skil',$teacherToLessonPriceData['lesson_id'],$id);
        if($id!=0){
           
            return $this->teacherToLessonPrice->updateOrCreate(
                ['user_id'=>$id,'lesson_id'=>$teacherToLessonPriceData['lesson_id']],
                ['user_id'=>$id,'lesson_id'=>$teacherToLessonPriceData['lesson_id'],'visible'=>1]
            );

            // $first=$this->first(['id'=>$id]);
            // return $first->updateOrCreate($teacherToLessonAndClassData);
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
       $query = $this->teacherToLessonPrice->query();

       // 'where' koşullarını eklemek için dizi içinde gelen koşulları döngüye al
       if(is_array($where))
       {
           foreach ($where as $column => $value)
           {
               $query->where($column, $value);
           }
       }
       return $query->orderByDesc('id')->get();
    }

    public function first(array $where)
   {
         // Veritabanı sorgusu oluştur
         $query = $this->teacherToLessonPrice->query();

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