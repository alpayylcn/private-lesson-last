<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Services\Backend\RequestDurationService;
use App\Http\Controllers\Controller;
use App\Models\Backend\RequestDuration;
use Illuminate\Http\Request;

class RequestDurationController extends Controller
{
    public function __construct(
        protected RequestDurationService $requestDurationService,
       ){} 
    public function index()
    {
        $durations = $this->requestDurationService->getAllDurations();
        return view('admin.student_request_durations.index', compact('durations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.student_request_durations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->requestDurationService->createDuration($request);
        toastr()->success('Ekleme İşlemi Başarılı.','Başarılı');
        return redirect()->route('request_durations.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(RequestDuration $requestDuration)
    {
        return view('admin.student_request_durations.show', compact('requestDuration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequestDuration $requestDuration)
    {
        return view('admin.student_request_durations.edit', compact('requestDuration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequestDuration $requestDuration)
    {
        $this->requestDurationService->updateDuration($request, $requestDuration);
        toastr()->success('Güncelleme İşlemi Başarılı.','Başarılı');
        return redirect()->route('request_durations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequestDuration $requestDuration)
    {
        $this->requestDurationService->deleteDuration($requestDuration);
        return response()->json(['success' => 'Silme İşlemi Başarılı.','Başarılı']);
    }
}
