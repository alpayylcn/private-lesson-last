<?php
namespace App\Services\Backend;

use App\Models\Backend\TeacherToLocation;
use App\Models\Backend\Wallet;
use Illuminate\Http\Request;

class TeacherToLocationService{

    public function __construct(protected TeacherToLocation $teacherToLocation){} 
       
    public function create(array $teacherToLocationData){
        
        return $this->teacherToLocation->create($teacherToLocationData);
        
    }

    public function update(array $teacherToLocationData,int $id=0){
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->update($teacherToLocationData);
        }
            return false;
        
    }

    public function updateOrCreate($teacherToLocationData,int $id=0){
        
        if($id!=0){
            //dd($teacherToLocationData);
            return $this->teacherToLocation->updateOrCreate(
                ['user_id'=>$id],
                ['location_id'=>$teacherToLocationData]
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
    public function deleteAll(int $id){
        
        $allData=$this->getWithWhere(['user_id'=>$id]);
        //dd($allData);
        if($allData->isNotEmpty()){
           foreach($allData as $data)
           {
                $deletedLocations=$data->delete();
           }
                if(!empty($deletedLocations))
                {
                   return $deletedLocations;
                }

        }else{
            
            $allData='table_is_empty';  
            return $allData;
        }
        
    }

    public function deleteLocations(int $id){

        $deleteClass=TeacherToLocation::where(['location_id'=>$id])->delete();
        
        return $deleteClass;
}
    public function getWithWhere(array $where = [])
   {
       // Veritabanı sorgusu oluştur
       $query = $this->teacherToLocation->query();

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
         $query = $this->teacherToLocation->query();

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