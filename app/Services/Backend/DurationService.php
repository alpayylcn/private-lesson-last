<?php

namespace App\Services\Backend;

use App\Models\Backend\Duration;
use Illuminate\Http\Request;

class DurationService
{
    public function getAllDurations()
    {
        return Duration::all();
    }

    public function createDuration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'days' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        return Duration::create($request->all());
    }

    public function getDurationById($id)
    {
        return Duration::findOrFail($id);
    }

    public function updateDuration(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'days' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $duration = Duration::findOrFail($id);
        $duration->update($request->all());

        return $duration;
    }

    public function deleteDuration($id)
    {
        $duration = Duration::findOrFail($id);
        $duration->delete();

        return ['success' => true];
    }
}