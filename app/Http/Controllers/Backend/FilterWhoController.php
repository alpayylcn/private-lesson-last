<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Backend\FilterWhoService;
use Illuminate\Http\Request;

class FilterWhoController extends Controller
{
    
    public function __construct(protected FilterWhoService $filterWhoService){} 
    
    public function index()
    {
        $index=$this->filterWhoService->getWithWhere(['id'=>1]);
        if (!empty($index)){
            
        }
    }

    public function filterLessonWhoEdit()
    {
        $data=$this->filterWhoService->getWithWhere();
        //dd($data->title);
        return view('admin.filter_lesson_who_edit',compact('data'));
        
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
        $store=$this->filterWhoService->create($request->all());
        if(!empty($store)){

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
        $update=$this->filterWhoService->update($request->all(),$id);
        if(!empty($update)){

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete=$this->filterWhoService->delete($id);
        if (!empty($delete)) {
           
        }
    }
}
