<?php
namespace App\Services\Backend;
use App\Models\Backend\FilterType;
use Illuminate\Http\Request;

class FilterTypeService{
        public function __construct(protected FilterType $filterType){}
       
        public function create(array $filterTypeData){
            return $this->filterType->create($filterTypeData);

        }

        public function update(array $filterTypeData, int $id=0){
            if($id!=0){
                $first=$this->first(['id',$id]);
                return $first->update($filterTypeData);
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
            $query = $this->filterType->query();
    
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
              $query = $this->filterType->query();
    
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