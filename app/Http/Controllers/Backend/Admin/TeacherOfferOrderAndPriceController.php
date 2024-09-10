<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backend\TeacherOfferOrderAndPrice;
use App\Http\Requests\StoreTeacherOfferOrderAndPriceRequest;
use App\Http\Requests\UpdateTeacherOfferOrderAndPriceRequest;
use App\Services\Backend\TeacherOfferOrderAndPriceService;
use Illuminate\Http\Request;

class TeacherOfferOrderAndPriceController extends Controller
{
    public function __construct(
        protected TeacherOfferOrderAndPriceService $teacherOfferOrderAndPriceService,
        
    ){}
    public function index()
    {
        //
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
    public function store(StoreTeacherOfferOrderAndPriceRequest $request)
    {
       
        $addOffers=$this->teacherOfferOrderAndPriceService->addOffer($request->offer_price);
        return response()->json(['message' => 'Teklif başarıyla eklendi.']);
       
    }

    /**
     * Display the specified resource.
     */
    public function show(TeacherOfferOrderAndPrice $teacherOfferOrderAndPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeacherOfferOrderAndPrice $teacherOfferOrderAndPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'offer_price' => 'required|numeric|min:0'
        ]);

        $this->teacherOfferOrderAndPriceService->updateOffer($id, $validated['offer_price']);
        return response()->json(['message' => 'Teklif başarıyla güncellendi.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->teacherOfferOrderAndPriceService->removeLastOffer();
        return response()->json(['message' => 'Son teklif başarıyla kaldırıldı.']);
    }
}
