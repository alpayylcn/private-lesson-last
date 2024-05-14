<?php
namespace App\Services\Backend;
use App\Models\Backend\OfferPrice;
use Illuminate\Http\Request;

class OfferPriceService{

    public function __construct(protected OfferPrice $offerPrice){} 
    public function create(array $offerPriceData){

        return $this->offerPrice->create($offerPriceData);
        
    }

    public function update(array $offerPriceData,int $id=0){
        if($id!=0){
            $first=$this->first(['id'=>$id]);
            return $first->update($offerPriceData);
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
       $query = $this->offerPrice->query();

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
         $query = $this->offerPrice->query();

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