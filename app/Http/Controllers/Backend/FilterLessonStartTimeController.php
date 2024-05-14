<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Backend\FilterLessonStartTimeService;
use Illuminate\Http\Request;

class FilterLessonStartTimeController extends Controller
{
    
    public function __construct(protected FilterLessonStartTimeService $filterLessonStartTimeService){}
   
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
    public function store(Request $request)
    {
        $store=$this->filterLessonStartTimeService->create($request->all());
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
        $update=$this->filterLessonStartTimeService->update($request->all(),$id);
        if(!empty($update)){

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroy=$this->filterLessonStartTimeService->delete($id);
        if(!empty ($destroy)){
            
        }
    }
}
