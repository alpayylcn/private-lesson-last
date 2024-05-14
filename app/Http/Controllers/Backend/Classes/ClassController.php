<?php

namespace App\Http\Controllers\Backend\Classes;

use App\Services\Backend\ClassService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Classes\ClassAddRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{

    
        public function __construct(protected ClassService $classService){ } // bu tek satır kodu diğer kontrollere uygula.
   
    public function index()
    {
        //$this->classService->index(); servisteki index fonksiyonunu çalıştırır.
        //$index=$this->classService->getWithWhere(['is_active'=>1,'id'=>1]); // servisteki getWithWhere fonksiyonuna git id si 1 ve is_active sütunu 1 olan değeri getir.
       // if(!empty ($index)){


        //}
        //dd('burası class controller');
        return view('classes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd('burası class  controller create');
    }
    public function addClassList()
    {
        $id=Auth::user()->id;
        //dd($id);
        $adminData=User::find($id);
        $classData=$this->classService->getWithWhere();
        $classDataTrashed=$this->classService->getWithWhereOnlyTrashed();
        if (!empty($classData)) {
            return view('admin.add_classes',compact('classData','classDataTrashed','adminData','id')); 
        }
    }

    public function store(ClassAddRequest $request)
    {
        //dd($request);
        $store=$this->classService->create($request->all());
        if(!empty ($store)){
            toastr()->success('Sınıf Ekleme İşlemi Başarılı', 'Başarılı', ["positionClass" => "toast-top-right"]);
            return redirect()->back();   

        }
    }

    public function deleteClasses(Request $request){
       
        $data=$this->classService->delete($request->id);
        if (!empty ($data)){
            return redirect()->back();
        }

    }
    public function restoreClasses(Request $request)
    {
        $data=$this->classService->restore($request->id);
        if (!empty ($data)){
            return redirect()->back();
        }
    }
    public function forceDeleteClasses(Request $request)
    {
        if(!$request->id)   
        {
            $class_id=0;
        } else
        {   
            $class_id=$request->id;
        }
        $data=$this->classService->forceDeleteClasses($class_id);
        //dd($data);
        if($data>0 && $data!='true'){
            toastr()->warning('Kullanımda olan ders/dersler silinemedi', 'Silinemeyen Dersler', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }elseif($data==0)
        {
            toastr()->success('Pasif Tüm dersler Tamamen silindi', 'Silindi', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }elseif($data=='true'){
            toastr()->success('Ders Tamamen Silindi', 'Silindi', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }elseif($data=='false'){
            
            return redirect()->back();
        }
        
    }
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update=$this->classService->update($request->all(),$id);
        if (!empty ($update)){
            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroy=$this->classService->delete($id);
        if (!empty ($destroy)){

        }
    }
}
