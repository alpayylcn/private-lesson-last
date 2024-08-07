<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Backend\WalletService;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    
        public function __construct(protected WalletService $walletService){}
    public function index()
    {
        $index=$this->walletService->getWithWhere(['id'=>1]);
        if(!empty ($index)){


        }
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
        $store=$this->walletService->create($request->all());
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
        $update=$this->walletService->update($request->all(),$id);
        if (!empty ($update)){
            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroy=$this->walletService->delete($id);
        if (!empty ($destroy)){

        }
    }
}
