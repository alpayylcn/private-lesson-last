<?php
namespace App\Services\Backend;

use App\Models\Backend\TeacherAppointmentList;
use App\Models\Backend\TeacherDetail;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class TeacherAppointmentListService{

       
    public function __construct(protected TeacherAppointmentList $teacherAppointmentList){}   
       
    public function create(array $teacherAppointmentListData){
        
        return $this->teacherAppointmentList->create($teacherAppointmentListData);
        
    }

    public function update(array $teacherAppointmentListData,int $id=0){
       
        if($id!=0){
            $first=$this->first(['user_id'=>$id]);
           
            return $first->update($teacherAppointmentListData);
        }
            return false;
        
    }
    public function updateOrCreate(array $teacherAppointmentListData,int $id=0){
        
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->updateOrCreate($teacherAppointmentListData);
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
       $query = $this->teacherAppointmentList->query();
       
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
         $query = $this->teacherAppointmentList->query();

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
            
            $query = $this->teacherAppointmentList->query();
            if(!empty ($where))
            {  
                $query->where('rank','>',$where);
            }
            
            return $query->orderBy('rank')->first();


            
        }
    }