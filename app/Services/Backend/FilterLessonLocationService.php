<?php
namespace App\Services\Backend;
use App\Models\Backend\FilterLessonLocation;
use Illuminate\Http\Request;

class FilterLessonLocationService{
 public function __construct(protected FilterLessonLocation $filterLessonLocation){}
       
        public function create(array $filterLessonData){
            return $this->filterLessonLocation->create($filterLessonData);

        }

        public function update(array $filterLessonData, int $id=0){

            if($id!=0){
                $first=$this->first(['id'=>$id]);
                return $first->update($filterLessonData);
            }

        }

        public function delete(int $id){
            $first=$this->first(['id',$id]);
            return $first->delete();
                
        }

        public function getWithWhere(array $where = [])
        {
            // Veritabanı sorgusu oluştur
            $query = $this->filterLessonLocation->query();
    
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
             $query = $this->filterLessonLocation->query();
   
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