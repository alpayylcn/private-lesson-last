<?php
namespace App\Services\Backend;
use App\Models\Backend\TeacherDetail;
use Illuminate\Http\Request;

class TeacherDetailService{

       
    public function __construct(protected TeacherDetail $teacherDetail){}   
       
    public function create(array $teacherDetailData){
        
        return $this->teacherDetail->create($teacherDetailData);
        
    }

    public function update(array $teacherDetailData,int $id=0){
        //dd('update service',$teacherDetailData,$id);
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->update($teacherDetailData);
        }
            return false;
        
    }
    public function updateOrCreate(array $teacherDetailData,int $id=0){
        
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->updateOrCreate($teacherDetailData);
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
       $query = $this->teacherDetail->query();
       
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
         $query = $this->teacherDetail->query();

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

        public function whereList(array $where = []){
            
            $query = $this->teacherDetail->query();
            if(!empty ($where))
            {  
                $query->where('rank','>',$where);
            }
            
            return $query->orderBy('rank')->first();


            
        }
    }