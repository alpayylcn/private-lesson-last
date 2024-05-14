<?php
namespace App\Services\Backend;
use App\Models\Backend\MonthlyAccountStatement;
use Illuminate\Http\Request;

class MonthlyAccountStatementService{

       
    public function __construct(protected MonthlyAccountStatement $monthlyAccountStatement){ } 
    public function create(array $monthlyAccountStatementData){

        return $this->monthlyAccountStatement->create($monthlyAccountStatementData);
        
    }

    public function update(array $monthlyAccountStatementData,int $id=0){
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->update($monthlyAccountStatementData);
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
       $query = $this->monthlyAccountStatement->query();

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
         $query = $this->monthlyAccountStatement->query();

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