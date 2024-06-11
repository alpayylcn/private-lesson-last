<?php
namespace App\Services\Backend;
use App\Models\Backend\StepQuestion;
use Illuminate\Http\Request;

class StepQuestionService{

    public function __construct(protected StepQuestion $stepQuestion){}
       
    public function create(array $stepQuestionData){
       
        return $this->stepQuestion->create($stepQuestionData);
        
    }

    public function update(array $stepQuestionData,int $id=0){
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->update($stepQuestionData);
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
       $query = $this->stepQuestion->query();

       // 'where' koşullarını eklemek için dizi içinde gelen koşulları döngüye al
       if(is_array($where))
       {
           foreach ($where as $column => $value)
           {
               $query->where($column, $value);
           }
       }
       return $query->orderByDesc('rank')->get();
    }

    public function lastRank(){
        $lastRank = StepQuestion::max('rank');
        return $lastRank;
    }
    public function first(array $where)
   {
         // Veritabanı sorgusu oluştur
         $query = $this->stepQuestion->query();

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

        public function whereRank(int $rankData){
            
            $query = $this->stepQuestion->query();
            if(!empty ($rankData))
            {  
                $query->where('rank','>',$rankData);
            }
            
            return $query->orderBy('rank')->first();


            
        }
    }