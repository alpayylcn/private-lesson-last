<?php
namespace App\Services\Backend;
use App\Models\Backend\TeacherProfile;
use Illuminate\Http\Request;

class TeacherProfileService{

    public function __construct(protected TeacherProfile $teacherProfile){} 
       
    public function create(array $teacherProfileData){

        return $this->teacherProfile->create($teacherProfileData);
        
    }

    public function update(array $teacherProfileData,int $id=0){
       // dd('Profile Service',$teacherProfileData,$id);
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->update($teacherProfileData);
        }
            return false;
        
    }

    public function updateOrCreate(array $teacherProfileData,int $id=0){
//dd('Profile Service',$teacherProfileData,$id);
        if($id!=0){
            //dd($teacherToLessonAndClassData);
            return $this->teacherProfile->updateOrCreate(
                ['user_id'=>$id],[$teacherProfileData]
            );

            // $first=$this->first(['id'=>$id]);
            // return $first->updateOrCreate($teacherToLessonAndClassData);
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
       $query = $this->teacherProfile->query();

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
         $query = $this->teacherProfile->query();

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