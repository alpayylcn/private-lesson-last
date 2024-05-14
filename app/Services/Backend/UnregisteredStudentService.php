<?php
namespace App\Services\Backend;
use App\Models\Backend\UnregisteredStudent;
use Illuminate\Http\Request;

class UnregisteredStudentService{

    public function __construct(protected UnregisteredStudent $unregisteredStudent){} 
    public function create(array $unregisteredStudentData){

        return $this->unregisteredStudent->create($unregisteredStudentData);
        
    }

    public function update(array $unregisteredStudentData,int $id=0){
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->update($unregisteredStudentData);
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
       $query = $this->unregisteredStudent->query();

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
         $query = $this->unregisteredStudent->query();

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