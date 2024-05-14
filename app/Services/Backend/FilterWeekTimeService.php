<?php
namespace App\Services\Backend;
use App\Models\Backend\FilterWeekTime;
use Illuminate\Http\Request;

class FilterWeekTimeService{

        public function __construct(protected FilterWeekTime $filterWeekTime){}
        public function create(array $filterWeekTimeData){
            return $this->filterWeekTime->create($filterWeekTimeData);

        }

        public function update(array $filterWeekTimeData, int $id=0){
            if($id!=0){
                $first=$this->first(['id',$id]);
                return $first->update($filterWeekTimeData);
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
            $query = $this->filterWeekTime->query();
    
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
              $query = $this->filterWeekTime->query();
    
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