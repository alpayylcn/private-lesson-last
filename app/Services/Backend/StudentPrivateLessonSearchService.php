<?php
namespace App\Services\Backend;
use App\Models\Backend\StudentFilter;
use App\Models\StudentPrivateLessonSearch;
use Illuminate\Http\Request;

class StudentPrivateLessonSearchService{

       
    public function __construct(protected StudentPrivateLessonSearch $studentPrivateLessonSearch){}   
       
    public function create(array $studentPrivateLessonSearchData){
        //dd($studentPrivateLessonSearchData);
        return $this->studentPrivateLessonSearch->create($studentPrivateLessonSearchData);
        
    }

    public function update(array $studentPrivateLessonSearchData,int $id=0){
        //dd('update service',$studentPrivateLessonSearchData,$id);
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->update($studentPrivateLessonSearchData);
        }
            return false;
        
    }
    public function updateOrCreate(array $studentPrivateLessonSearchData,string $sessionId){
        
        if($sessionId){
            return $this->studentPrivateLessonSearch->updateOrCreate(
            
                ['session_id' => $sessionId],
                [$studentPrivateLessonSearchData]
            );

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
       $query = $this->studentPrivateLessonSearch->query();

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
         $query = $this->studentPrivateLessonSearch->query();

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