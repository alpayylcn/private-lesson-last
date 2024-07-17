<?php
namespace App\Services\Backend;
use App\Models\Backend\TeacherDetail;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class UserService{

       
    public function __construct(protected User $users){}   
       

    public function getTeachers($search = null)
    {
        $query = $this->users->role('teacher')->with('userDetails');//Rolü Teacher olan kullanıcıları getir

        if ($search) { // arama parametresi gelirse bu satırları çalıştır.
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        return $query->paginate(1);//bir sayfada bulunacak satır sayısı
    }

    public function countTeachers()
    {
        return [
            'total' => $this->users->role('teacher')->count(), //Toplam kayıtlı öğretmen sayısı
            'unapproved' => $this->users->role('teacher')->where('approved', 0)->count(), //Onay bekleyen öğretmenlerin sayısı
        ];
    }

    public function getStudents($search = null)
    {
        $query = $this->users->role('student')->with('userDetails');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        return $query->paginate(1);
    }
    public function countStudents()
    {
        return [
            'total' => $this->users->role('student')->count(),
            'unapproved' => $this->users->role('student')->where('approved', false)->count(),
        ];
    }

    public function approveUser($userId, $approved)
    {
        $user = $this->users->find($userId);

        if ($user) {
            $user->approved = $approved;
            $user->save();
            return $user;
        }

        return null;
    }
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