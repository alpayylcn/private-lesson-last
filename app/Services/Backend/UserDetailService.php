<?php
namespace App\Services\Backend;
use App\Models\Backend\TeacherDetail;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class UserDetailService{

       
    public function __construct(protected UserDetail $userDetail){}   
       
    public function create(array $userDetailData){
        
        return $this->userDetail->create($userDetailData);
        
    }

    public function update(array $userDetailData,int $id=0){
        //dd('update service',$userDetailData,$id);
        if($id!=0){
            $first=$this->first(['user_id'=>$id]);
           // dd($first);
            return $first->update($userDetailData);
        }
            return false;
        
    }
    public function updateOrCreate(array $userDetailData,int $id=0){
        
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->updateOrCreate($userDetailData);
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
       $query = $this->userDetail->query();
       
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
         $query = $this->userDetail->query();

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
            
            $query = $this->userDetail->query();
            if(!empty ($where))
            {  
                $query->where('rank','>',$where);
            }
            
            return $query->orderBy('rank')->first();


            
        }
    }