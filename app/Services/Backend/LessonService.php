<?php
namespace App\Services\Backend;
use App\Models\Backend\Lesson;
use Illuminate\Http\Request;

class LessonService{

        public function __construct(
            protected Lesson $lesson,
            protected LessonToClassService $lessonToClassService,
        ){}
        public function create(array $lessonData){
            return $this->lesson->create($lessonData);

        }

        public function update(array $lessonData, int $id=0){
            if ($id!=0) {
                $first=$this->first(['id'=>$id]);
                return $first->update($lessonData);
            }
                return false;
        }

        public function delete(int $id=0){
            $first=$this->first(['id'=>$id]);
            return $first->delete();
        }

        public function forceDeleteLessons(int $lesson_id=0){ 
           // dd($lesson_id);
           if($lesson_id==0){
            $data=Lesson::onlyTrashed()->get('id');
            foreach ($data as $lesson){
                if ($lesson->teacher_to_lessons()->count() == 0 && 
                    $lesson->teacher_to_lesson_price()->count() == 0
                    )
                    {
                        $this->lessonToClassService->deleteLessonToClasses($lesson->id);
                        $lesson->forceDelete();
                    }
                }
                return Lesson::onlyTrashed()->get('id')->count();
            }elseif($lesson_id!=0)
            {  
                $lesson = $this->firstWithTrashed(['id'=>$lesson_id]);
                
                if ($lesson->teacher_to_lessons()->count() == 0 && 
                    $lesson->teacher_to_lesson_price()->count() == 0
                    ){
                        //dd($lesson->id);
                        //$this->lessonToClassService->deleteLessonToClasses($lesson->id);
                        return $lesson->forceDelete();
                    }else{
                        return Lesson::get('id')->count();
                    }
                
            }
        }
        public function restore(int $id=0){
           $restore= Lesson::withTrashed() 
                ->where('id',$id)
                ->restore();
            return $restore;
        }

        public function getWithWhere(array $where = [])
        {
            // Veritabanı sorgusu oluştur 
            $query = $this->lesson->query();
    
            // 'where' koşullarını eklemek için dizi içinde gelen koşulları döngüye al
            if(is_array($where))
            {
                foreach ($where as $column => $value)
                {
                    $query->where($column, $value);
                }
            }
            return $query->orderByDesc('id')->withTrashed()->get();
         }
         public function getWithWhereOnlyTrashed(array $where = [])
        {
            // Veritabanı sorgusu oluştur 
            $query = $this->lesson->query();
    
            // 'where' koşullarını eklemek için dizi içinde gelen koşulları döngüye al
            if(is_array($where))
            {
                foreach ($where as $column => $value)
                {
                    $query->where($column, $value);
                }
            }
            return $query->orderByDesc('id')->onlyTrashed()->get();
         }
 
         public function first(array $where)
        {
              // Veritabanı sorgusu oluştur
              $query = $this->lesson->query();
    
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

             public function firstWithTrashed(array $where)
        {
              // Veritabanı sorgusu oluştur
              $query = $this->lesson->query();
    
              // 'where' koşullarını eklemek için dizi içinde gelen koşulları döngüye al
              if(is_array($where))
              {
                  foreach ($where as $column => $value)
                  {
                      $query->where($column, $value)->withTrashed();
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