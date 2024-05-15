<?php

namespace App\Http\Controllers;

use App\Http\Requests\Backend\UserDetails\UserDetailRequest;
use App\Models\City;
use App\Models\County;
use App\Models\User;
use App\Models\UserDetail;
use App\Services\Backend\TeacherGeneralService;
use App\Services\Backend\UserDetailService;
use App\Services\Backend\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDetailController extends Controller
{
    public function __construct(
        
        protected TeacherGeneralService $teacherGeneralService,
        protected UserDetailService $userDetailService,
        protected UserService $userService,
        
        ){}
    public function UserEditProfile()   
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        $userDetailData=UserDetail ::where('user_id',$id)->first();
        $data=$this->teacherGeneralService->general();
        if(!empty($userDetailData)){
            $cityData=City::where('id',$userDetailData->city)->first();
            //dd($userDetailData->city);
        }
        else{
            $cityData='';
        }
        $allCity=City::get();
        //dd($cityData);
        return view('teachers.teacher_profile',compact('userData','userDetailData','cityData','allCity','data'));
    }

    public function UserDetailUpdate(UserDetailRequest $request){
       
       $id=Auth::user()->id;
       
       if ($request->file('profile_image')) {
        $file = $request->file('profile_image');
        @unlink(public_path('Backend\assets\img\profileimages/'.$request->profile_image));
        $filename = time() .-$id. '.' .$file->getClientOriginalExtension();
        $file->move(public_path('Backend\assets\img\profileimages'), $filename);
       // dd($filename);
       
        $updateImage = UserDetail::where('user_id', $id)->update(['profile_image' => $filename]);
           
        }
 
        $requestData = $request->only(['name', 'surname', 'email']);
        $id=Auth::user()->id;
        $detailUpdate=$this->userDetailService->update($request->except('_token','profile_image'),$id);
        $userUpdate=$this->userService->update($requestData,$id);
        if (!empty($detailUpdate)) 
        {
        toastr()->success('Güncelleme İşlemi Başarılı', 'Başarılı', ["positionClass" => "toast-top-right"]);
        return redirect()->back();  
        }
    }
    public function fetchCounty(Request $request)
    {   
        $data['counties'] = County::where('city_id',$request->country_id)->get();
        
        return response()->json($data);
    }
}
