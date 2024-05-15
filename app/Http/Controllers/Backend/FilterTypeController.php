<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Backend\FilterTypeService;
use Illuminate\Http\Request;

class FilterTypeController extends Controller
{
    
    public function __construct(protected FilterTypeService $filterTypeService){}   
    
    public function index()
    {
        $index=$this->filterTypeService->getWithWhere(['id',1]);
        if(!empty($index)){

        }

    }
    public function filterLessonTypeEdit()
    {
        $data=$this->filterTypeService->getWithWhere();
        //dd($data->title);
        return view('admin.filter_lesson_type_edit',compact('data'));
        
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
        $store=$this->filterTypeService->create($request->all());
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
        $update=$this->filterTypeService->update($request->all(),$id);
        if(!empty($update)){

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroy=$this->filterTypeService->delete($id);
        if(!empty($destroy)){
            
        }
    }
}
