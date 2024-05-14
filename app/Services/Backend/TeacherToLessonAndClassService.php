<?php
namespace App\Services\Backend;
use App\Models\Backend\TeacherToLessonAndClass;
use Illuminate\Http\Request;

class TeacherToLessonAndClassService{

       
    public function __construct(protected TeacherToLessonAndClass $teacherToLessonAndClass){}   
       
    public function create(array $teacherToLessonAndClassData){
        
        return $this->teacherToLessonAndClass->create($teacherToLessonAndClassData);
        
    }

    public function update(array $teacherToLessonAndClassData,int $id=0){
        //dd('update service',$teacherDetailData,$id);
        if($id!=0){ 
            $first=$this->first(['id'=>$id]);
            return $first->update($teacherToLessonAndClassData);
        }
            return false;
        
    }
    public function updateOrCreate(array $teacherToLessonAndClassData,int $id=0){
        
        if($id!=0){
            //dd($teacherToLessonAndClassData);
            return $this->teacherToLessonAndClass->updateOrCreate(
                ['user_id'=>$id,'lesson_id'=>$teacherToLessonAndClassData[0],'class_id'=>$teacherToLessonAndClassData[1]],
                ['lesson_id'=>$teacherToLessonAndClassData[0],'class_id'=>$teacherToLessonAndClassData[1]]
            );

            
        }
            return false;
        
    }
    

    public function delete(int $id){

            $first=$this->first(['id'=>$id]);
            return $first->delete();
    }

    public function deleteAll(int $id){
        
        $allData=$this->getWithWhere(['user_id'=>$id]);
        //dd($allData);
        if($allData->isNotEmpty()){
           foreach($allData as $data)
           {
                $deletedLessonAndClass=$data->delete();
           }
                if(!empty($deletedLessonAndClass))
                {
                   return $deletedLessonAndClass;
                }

        }else{
            
            $allData='table_is_empty';  
            return $allData;
        }
        
    }
    public function deleteClasses(int $id){

        $deleteClass=TeacherToLessonAndClass::where(['class_id'=>$id])->delete();
        
        return $deleteClass;
}

    public function deleteLessons(int $id){

        $deleteLesson=TeacherToLessonAndClass::where(['lesson_id'=>$id])->delete();
        
        return $deleteLesson;
    }

    public function getWithWhere(array $where = [])
   { 
       // Veritabanı sorgusu oluştur
       $query = $this->teacherToLessonAndClass->query();
       
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

    public function getWithWhereLesson(array $where = [])
    { 
        // Veritabanı sorgusu oluştur
        $query = $this->teacherToLessonAndClass->query();
        
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

     public function getWithWhereClass(array $where = [])
    { 
        // Veritabanı sorgusu oluştur
        $query = $this->teacherToLessonAndClass->query();
        
        // 'where' koşullarını eklemek için dizi içinde gelen koşulları döngüye al
        if(is_array($where))
        {
         
            foreach ($where as $column => $value)
            {
                $query->where($column, $value);
            }
        }
        return $query->groupBy('class_id')->get('class_id');
     }
    public function first(array $where)
   {
         // Veritabanı sorgusu oluştur
         $query = $this->teacherToLessonAndClass->query();

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

        public function whereList(array $where = []){
            
            $query = $this->teacherToLessonAndClass->query();
            if(!empty ($where))
            {  
                $query->where('rank','>',$where);
            }
            
            return $query->orderBy('rank')->first();


            
        }
    }