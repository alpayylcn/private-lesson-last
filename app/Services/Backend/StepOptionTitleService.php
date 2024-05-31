<?php
namespace App\Services\Backend;
use App\Models\Backend\StepOption;
use App\Models\Backend\StepOptionTitle;
use Illuminate\Http\Request;

class StepOptionTitleService{

    public function __construct(protected StepOptionTitle $stepOptionTitle){}
       
    public function create(array $stepOptionTitleData){

        return $this->stepOptionTitle->create($stepOptionTitleData);
        
    }

    public function update(array $stepOptionTitleData,int $id=0){
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->update($stepOptionTitleData);
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
       $query = $this->stepOptionTitle->query();

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

    public function first(array $where)
   {
         // Veritabanı sorgusu oluştur
         $query = $this->stepOptionTitle->query();

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