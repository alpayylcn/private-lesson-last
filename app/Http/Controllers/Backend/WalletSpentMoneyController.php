<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Backend\WalletSpentMoneyService;
use Illuminate\Http\Request;

class WalletSpentMoneyController extends Controller
{
    
   public function __construct(protected WalletSpentMoneyService $walletSpentMoneyService){}
    public function index()
    {
        $index=$this->walletSpentMoneyService->getWithWhere(['id'=>1]);
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
        $store=$this->walletSpentMoneyService->create($request->all());
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
        $update=$this->walletSpentMoneyService->update($request->all(),$id);
        if (!empty ($update)){
            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroy=$this->walletSpentMoneyService->delete($id);
        if (!empty ($destroy)){

        }
    }
}
