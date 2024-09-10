<?php

namespace App\Http\Controllers\Backend\Wallet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Wallet\WalletRequest;
use App\Services\Backend\WalletService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    
        public function __construct(protected WalletService $walletService){}
    public function index()
    {
        
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
    public function store(WalletRequest $request): JsonResponse
    {
       

        $wallet = $this->walletService->addMoney($request->amount);

        return response()->json([
            'message' => 'Yükleme başarılı!',
            'balance' => $wallet->balance,
        ]);
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
