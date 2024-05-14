<?php
namespace App\Services\Backend;
use App\Models\Backend\StudentFilter;
use Illuminate\Http\Request;

class StudentFilterService{

       
    public function __construct(protected StudentFilter $studentFilter){}   
       
    public function create(array $studentFilterData){

        return $this->studentFilter->create($studentFilterData);
        
    }

    public function update(array $studentFilterData,int $id=0){
        //dd('update service',$studentFilterData,$id);
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->update($studentFilterData);
        }
            return false;
        
    }
    public function updateOrCreate(array $filterAllStepData,int $id=0){
        
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->updateOrCreate($filterAllStepData);
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
       $query = $this->studentFilter->query();

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
         $query = $this->studentFilter->query();

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