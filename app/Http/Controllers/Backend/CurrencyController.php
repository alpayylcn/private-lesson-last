<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Backend\CurrencyService;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{ 
    
        public function __construct(protected CurrencyService $currencyService){ } 
    
    public function index(int $id)
    {
        $this->currencyService->getWithWhere(['id'=>$id]); // servisteki getWithWhere fonksiyonuna git id si 1 olan değeri getir.
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $store=$this->currencyService->create($request->all());
        if(!empty($store)){

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
        $update= $this->currencyService->update($request->all(),$id);
        if(!empty ($update)){


        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroy=$this->currencyService->delete($id);
        if(!empty($destroy)){

        }
    }
}
