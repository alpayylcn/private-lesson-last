<?php
namespace App\Services\Backend;
use App\Models\Backend\FilterLessonStartTime;
use Illuminate\Http\Request;

class FilterLessonStartTimeService{ 

    public function __construct(protected FilterLessonStartTime $filterLessonStartTime){}

        
        public function create(array $filterLessonStartTimeData){
            
            return $this->filterLessonStartTime->create($filterLessonStartTimeData);

        }

        public function update(array $filterLessonStartTimeData, int $id=0){
            if($id!=0){
                $first=$this->first(['id',$id]);
                return $first->update($filterLessonStartTimeData);

            }
                return false;


        }

        public function delete(int $id){
            $first=$this->first(['id',$id]);
            return $first->delete();
                
        }

        public function getWithWhere(array $where = [])
        {
            // Veritabanı sorgusu oluştur
            $query = $this->filterLessonStartTime->query();
    
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
              $query = $this->filterLessonStartTime->query();
    
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