<?php
namespace App\Services\Backend;

use App\Models\Backend\Currency as BackendCurrency;
use App\Models\Backend\Currency;
use Illuminate\Http\Request;

class CurrencyService{
    public function __construct(protected Currency $currencies){ } 
        
        public function create(array $currencyData){
           
            return $this->currencies->create($currencyData);
            
        } 

        public function update(array $currencyData,int $id=0){
            if($id!=0){
                $first=$this->first(['id'=> $id]);
                if (!empty($first)) {
                    return $first->update($currencyData);
                }
                
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
           $query = $this->currencies->query();
   
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
             $query = $this->currencies->query();
   
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