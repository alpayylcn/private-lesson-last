<?php
namespace App\Services\Backend;
use App\Models\Backend\Classes;
use Illuminate\Http\Request;

class ClassService{
    public function __construct(protected Classes $classes){ } // bu tek satır kodu diğer servicelere uygula.
       
        public function create(array $classesData){

            return $this->classes->create($classesData);
            
        }

        public function update(array $classesData,int $id=0){
            if($id!=0){
                $first=$this->first(['id'=>$id]);
                return $first->update($classesData);
            }
                return false;
            
        }

        public function delete(int $id){ 

                $first=$this->first(['id'=>$id]);
                return $first->delete();
        }
        public function restore(int $id=0){
            $restore= Classes::withTrashed()
                 ->where('id',$id)
                 ->restore();
             return $restore;
         }

         public function forceDeleteClasses(int $class_id=0){
            
            if($class_id==0){
             $data=Classes::onlyTrashed()->get('id');
             foreach ($data as $class){
                 if ($class->teacher_to_classes()->count() == 0)
                     {
                         $class->forceDelete();
                     }
                 }
                 return Classes::onlyTrashed()->get('id')->count();
             }elseif($class_id!=0)
             {  
                 $class = $this->firstWithTrashed(['id'=>$class_id]);
                 
                 if ($class->teacher_to_classes()->count() == 0) 
                     {
                         return $class->forceDelete();
                     }else{
                         return Classes::get('id')->count();
                     }
                 
             }
         }

        public function getWithWhere(array $where = [])
       {
           // Veritabanı sorgusu oluştur
           $query = $this->classes->query();
   
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
           $query = $this->classes->query();
   
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
             $query = $this->classes->query();
   
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
             $query = $this->classes->query();
   
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