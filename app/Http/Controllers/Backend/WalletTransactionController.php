<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Backend\WalletTransactionService;
use Illuminate\Http\Request;

class WalletTransactionController extends Controller
{
    
    public function __construct(protected WalletTransactionService $walletTransactionService){}
    public function index()
    {
        
        $index=$this->walletTransactionService->getWithWhere(['is_active'=>1,'id'=>1]); 
        if(!empty ($index)){


        }
        
    }

    
    public function create()
    {
        
    }

    
    public function store(Request $request)
    {
        $store=$this->walletTransactionService->create($request->all());
        if(!empty ($store)){


        }
    }

    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        //
    }

    
    public function update(Request $request, string $id)
    {
        $update=$this->walletTransactionService->update($request->all(),$id);
        if (!empty ($update)){
            
        }
    }

    
    public function destroy(string $id)
    {
        $destroy=$this->walletTransactionService->delete($id);
        if (!empty ($destroy)){

        }
    }
}