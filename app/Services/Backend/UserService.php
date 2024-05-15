<?php
namespace App\Services\Backend;
use App\Models\Backend\TeacherDetail;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class UserService{

       
    public function __construct(protected User $users){}   
       
    public function create(array $usersData){
        
        return $this->users->create($usersData);
        
    }

    public function update(array $usersData,int $id=0){
        //dd('update service',$userDetailData,$id);
        if($id!=0){
            $first=$this->first(['id'=>$id]);
           // dd($first);
            return $first->update($usersData);
        }
            return false;
        
    }
    public function updateOrCreate(array $usersData,int $id=0){
        
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->updateOrCreate($usersData);
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
       $query = $this->users->query();
       
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
         $query = $this->users->query();

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
            
            $query = $this->users->query();
            if(!empty ($where))
            {  
                $query->where('rank','>',$where);
            }
            
            return $query->orderBy('rank')->first();


            
        }
    }