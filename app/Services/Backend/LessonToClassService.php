<?php
namespace App\Services\Backend;
use App\Models\Backend\LessonToClass;
use Illuminate\Http\Request;

class LessonToClassService{  

    public function __construct(protected LessonToClass $lessonToClass){ }
       
    public function create(array $lessonToClassData){

        return $this->lessonToClass->create($lessonToClassData);
        
    }

    public function update(array $lessonToClassData,int $id=0){
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->update($lessonToClassData);
        }
            return false;
        
    } 
    public function adminLessonToClassesDeleteAjax(array $lessonToClassIdData){
        
       // dd($lessonToClassIdData);
        $dd=LessonToClass::whereNotIn('id', $lessonToClassIdData)->delete();
dd($dd);
        
        $classesData=$this->getWithWhere();
        if(!empty($lessonToClassIdData['item_ids'])){
            foreach($classesData as $class){
                foreach($lessonToClassIdData['item_ids'] as $key=>$lessonToClassId){
                  if($class->id != $lessonToClassId){
                    $lessonToClassDeleted=$this->delete($class->id);
                  }
                }
                
                //dd($class->id);
                
            }
            //return $lessonToClassDeleted;
        }
      
    }

    public function updateOrCreate(array $lessonToClassData,int $id=0){
        //dd($lessonToClassData['class_id'],$id);
        if($id!=0){
            
            return $this->lessonToClass->updateOrCreate(
                ['lesson_id'=>$id,'class_id'=>$lessonToClassData['class_id']],
                ['class_id'=>$lessonToClassData['class_id']]
            );

            
        }
            return false;
        
    }

    public function delete(int $id){

            $first=$this->first(['id'=>$id]);
            return $first->delete();
    }
    public function deleteLessonToClasses(int $id){

        $lessonToClasses=$this->getWithWhere(['lesson_id'=>$id]);
        foreach($lessonToClasses as $data){
            $data->delete();
        }
        return $data;
        
}

    public function getWithWhere(array $where = [])
   {
       // Veritabanı sorgusu oluştur
       $query = $this->lessonToClass->query();

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

    public function getWithWhereGroupLesson(array $where = [])
    {
        // Veritabanı sorgusu oluştur
        $query = $this->lessonToClass->query();
 
        // 'where' koşullarını eklemek için dizi içinde gelen koşulları döngüye al
        if(is_array($where))
        {
            foreach ($where as $column => $value)
            {
                $query->where($column, $value);
            }
        }
        return $query->groupBy('lesson_id')->get('lesson_id');
     }
       

    public function first(array $where)
   {
         // Veritabanı sorgusu oluştur
         $query = $this->lessonToClass->query();

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