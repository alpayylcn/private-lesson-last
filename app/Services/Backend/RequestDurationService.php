<?php
namespace App\Services\Backend;

use App\Models\Backend\RequestDuration;
use Illuminate\Http\Request;

class RequestDurationService
{
    public function getAllDurations()
    {
        return RequestDuration::all();
    }

    public function createDuration(Request $request)
    {
        $validated = $request->validate([
            'request_type' => 'required|string|max:255',
            'duration_days' => 'required|integer|min:1',
        ]);

        return RequestDuration::create($validated);
    }

    public function updateDuration(Request $request, RequestDuration $requestDuration)
    {
        $validated = $request->validate([
            'request_type' => 'required|string|max:255',
            'duration_days' => 'required|integer|min:1',
        ]);

        return $requestDuration->update($validated);
    }

    public function deleteDuration(RequestDuration $requestDuration)
    {
        return $requestDuration->delete();
    }
}
