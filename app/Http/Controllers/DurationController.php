<?php

namespace App\Http\Controllers;

use App\Http\Requests\Backend\Durations\DurationRequest;
use App\Models\Backend\Duration;
use App\Services\Backend\DurationService;
use Illuminate\Http\Request;

class DurationController extends Controller
{
    public function __construct(
        protected DurationService $durationService,
     ){}   
    public function index()
    {
        $durations = $this->durationService->getAllDurations();
        return view('admin.durations.index', compact('durations'));
    }

    public function store(DurationRequest $request)
    {
        $duration = $this->durationService->createDuration($request);
        return response()->json($duration);
    }

    public function show($id)
    {
        $duration = $this->durationService->getDurationById($id);
        return response()->json($duration);
    }

    public function update(Request $request, $id)
    {
        $duration = $this->durationService->updateDuration($request, $id);
        return response()->json($duration);
    }

    public function destroy($id)
    {
        $result = $this->durationService->deleteDuration($id);
        return response()->json($result);
    }
}
