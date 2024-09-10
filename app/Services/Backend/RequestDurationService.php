<?php
namespace App\Services\Backend;

use App\Models\Backend\Duration;
use App\Models\Backend\RequestDuration;
use Illuminate\Http\Request;

class RequestDurationService
{
    

    public function firstDuration()
    {
        return RequestDuration::first();
    }
   


    public function updateRequestDuration(int $durationId,int $durationDays)
    {
        $duration = RequestDuration::find($durationId);
        if ($duration) {
            $duration->duration_days = $durationDays;
            $duration->save();
            return true;
        }
        return false;
    }

    

    public function deleteDuration(RequestDuration $requestDuration)
    {
        return $requestDuration->delete();
    }
}
