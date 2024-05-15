<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\LessonLocation\LessonLocationAddRequest;
use App\Http\Requests\Backend\LessonLocation\LessonLocationUpdateRequest;
use App\Models\Backend\FilterLessonLocation;
use App\Services\Backend\FilterLessonLocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilterLessonLocationController extends Controller
{
 
    
    public function __construct(protected FilterLessonLocationService $filterLessonLocationService){}
   
    public function index()
    {
        $index= $this->filterLessonLocationService->getWithWhere(['id',1]);
        if(!empty($index)){

        }
    }

    public function filterLessonLocationEdit()
    {   $userId=Auth::user()->id;
        $data=$this->filterLessonLocationService->getWithWhere();
        //dd($data->title);
        return view('admin.filter_lesson_location_edit',compact('data','userId'));
        
    }

    public function filterLessonLocationAdd(LessonLocationAddRequest $request)
    {   
      // dd('soru ekleme',$request);
        $userId=Auth::user()->id;
       
        $locationAdd=$this->filterLessonLocationService->create($request->except('_token'));
        if(!empty($locationAdd)){
           $data=$this->filterLessonLocationService->getWithWhere();
        //dd($data->title);
        toastr()->success('Ekleme İşlemi Başarılı', 'Başarılı', ["positionClass" => "toast-top-right"]);
        return back();  
        }
       
        
    }

    public function filterLessonLocationUpdate(LessonLocationUpdateRequest $request)
    {   //dd($request);
        $userId=Auth::user()->id;
        foreach ($request->title as $id => $title) 
        {
            // ID'ye göre modeli bul
            
            $model = FilterLessonLocation::find($id);
            //dd($model);
            // Eğer model bulunursa ve title değeri farklıysa güncelle
            if ($model && $model->title != $title) {
                $model->title = $title;
                $model->save(); // Güncelleme işlemi
            }  
        }
        foreach ($request->teacher_title as $id => $teacher_title) 
        {
            // ID'ye göre modeli bul
            
            $model = FilterLessonLocation::find($id);
            //dd($model);
            // Eğer model bulunursa ve title değeri farklıysa güncelle
            if ($model && $model->teacher_title != $teacher_title) {
                $model->teacher_title = $teacher_title;
                $model->save(); // Güncelleme işlemi
            }  
        }
       
        toastr()->success('Güncelleme İşlemi Başarılı', 'Başarılı', ["positionClass" => "toast-top-right"]);
        return back();
        
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $store=$this->filterLessonLocationService->create($request->all());
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
        $update=$this->filterLessonLocationService->update($request->all(),$id);
        if(!empty($update)){

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete=$this->filterLessonLocationService->delete($id);
        if(!empty ($delete)){

        }
    }
}
