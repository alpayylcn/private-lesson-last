<?php

namespace App\Http\Controllers\Backend;

use App\Services\Backend\ClassService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $store=$this->classService->create($request->all());
        if(!empty ($store)){


        }
    }

    /**
     * Display the specified resource.
     */
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
