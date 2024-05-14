<?php
namespace App\Services\Backend;
use App\Models\Backend\FilterLessonTimePeriod;
use Illuminate\Http\Request;

class FilterLessonTimePeriodService{

        public function __construct(protected FilterLessonTimePeriod $filterLessonTimePeriod){}
        
        public function create(array $filterLessonTimePeriodData){
            
            return $this->filterLessonTimePeriod->create($filterLessonTimePeriodData);

        }

        public function update(array $filterLessonTimePeriodData, int $id=0){
            if($id!=0){
                $first=$this->first(['id',$id]);
                return $first->update($filterLessonTimePeriodData);
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
           $query = $this->filterLessonTimePeriod->query();
   
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
             $query = $this->filterLessonTimePeriod->query();
   
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