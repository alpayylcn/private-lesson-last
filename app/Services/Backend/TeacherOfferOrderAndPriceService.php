<?php
namespace App\Services\Backend;

use App\Models\Backend\TeacherOfferOrderAndPrice;

class TeacherOfferOrderAndPriceService
{
    public function addOffer($offerPrice)
    {
        $lastOfferOrder = TeacherOfferOrderAndPrice::max('offer_order');
        $newOfferOrder = $lastOfferOrder ? $lastOfferOrder + 1 : 1;

        return TeacherOfferOrderAndPrice::create([
            'offer_order' => $newOfferOrder,
            'offer_price' => $offerPrice
        ]);
    }

    public function removeLastOffer()
    {
        $lastOffer = TeacherOfferOrderAndPrice::orderBy('offer_order', 'desc')->first();
        if ($lastOffer) {
            $lastOffer->delete();
        }
    }

    public function updateOffer($id, $offerPrice)
    {
        $offer = TeacherOfferOrderAndPrice::find($id);
        if ($offer) {
            $offer->update(['offer_price' => $offerPrice]);
        }
    }

    public function getOffers()
    {
        return TeacherOfferOrderAndPrice::orderBy('offer_order')->get();
    }
}
