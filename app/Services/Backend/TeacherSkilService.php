<?php
namespace App\Services\Backend;
use App\Models\Backend\TeacherSkil;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class TeacherSkilService{

    public function __construct(
        protected TeacherSkil $teacherSkil,
        protected LessonToClassService $lessonToClassService,
        protected LessonService $lessonService,
    
    ){} 
    

    public function lessonToClassesAjax(array $lessonIdData)
    {
        //dd($lessonIdData['item_ids']);
    $uniqueValues = [];
    if(!empty($lessonIdData['item_ids'])){
        foreach($lessonIdData['item_ids'] as $key=>$lessonId)
        {
            $lessonFind=$this->lessonService->first(['id'=>$lessonId]);
            if(!empty($lessonFind))
            {
                foreach ($lessonFind->lesson_to_classes as $item) 
                {
                       // Log::info($item->classes->title);
                        if (!in_array($item->classes->title, $uniqueValues))
                        {
                            $uniqueValues[$item->classes->id] = $item->classes->title;
                        }
                    }
    
                }
        }
    }
       // dd($uniqueValues);
       return $uniqueValues;
}
   
    public function create(array $teacherSkilData){

        return $this->teacherSkil->create($teacherSkilData);
        
    }

    public function update(array $teacherSkilData,int $id=0){
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->update($teacherSkilData);
        }
            return false;
        
    }

    public function updateOrCreate(array $teacherSkilData,int $id=0){
        
        if($id!=0){
           dd('servis skil',$teacherSkilData,$id);
            return $this->teacherSkil->updateOrCreate(
                ['user_id'=>$id,'lesson_id'=>$teacherSkilData[0]],
                ['lesson_minute'=>$teacherSkilData[1]['8']]
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
       $query = $this->teacherSkil->query();

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
         $query = $this->teacherSkil->query();

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