<?php
namespace App\Services\Backend;
use App\Models\Backend\TeacherDetail;
use App\Models\Backend\TeacherProfile;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherGeneralService{

       
    public function __construct(
        protected TeacherDetailService $teacherDetailService,
        protected LessonService $lessonService,
        protected ClassService $classService,
        protected TeacherToLessonAndClassService $teacherToLessonAndClassService,
        protected TeacherToLessonPriceService $teacherToLessonPriceService,
        protected TeacherToLocationService $teacherToLocationService,
        protected FilterLessonLocationService $filterLessonLocationService,
        protected TeacherProfileService $teacherProfileService,
        protected TeacherSkilService $teacherSkilService,
        protected LessonToClassService $lessonToClassService,
        protected UserDetailService $userDetailService,
        

        
        ){}   
       
    public function general(){
        
        $id=Auth::user()->id;
         
        if (!empty ($id)){
        $lessons=$this->lessonService->getWithWhere();  
        $classes=$this->classService->getWithWhere(); 
        $lessonToClasses=$this->lessonToClassService->getWithWhereGroupLesson(); 
        $teacherData=$this->teacherDetailService->first(['user_id'=>$id]); //user modeline eklenecek hasmany ve hasone kullanılacak
        $userDetailData=$this->userDetailService->first(['user_id'=>$id]);
        $locations=$this->filterLessonLocationService->getWithWhere();
        $teacherToLesson=$this->teacherToLessonAndClassService->getWithWhereLesson(['user_id'=>$id]); //user modeline eklenecek hasmany ve hasone kullanılacak
        $teacherToClass=$this->teacherToLessonAndClassService->getWithWhereClass(['user_id'=>$id]); //user modeline eklenecek hasmany ve hasone kullanılacak
        $teacherProfileData=$this->teacherProfileService->first(['user_id'=>$id]); //user modeline eklenecek hasmany ve hasone kullanılacak
        $teacherToLocation=$this->teacherToLocationService->getWithWhere(['user_id'=>$id]);
        $teacherToLessonPrice=$this->teacherToLessonPriceService->getWithWhere(['user_id'=>$id]);
        //return [$lessons,$classes]; aslı bu şekilde olacak 
        return compact('lessons','classes','lessonToClasses','teacherData',
        'locations','teacherToLesson','teacherProfileData','teacherToClass',
        'teacherToLocation','teacherToLessonPrice','userDetailData');  
        }
       
        
    }
    public function updateTeacherDetails(array $teacherProfileData,int $id=1){
        //dd($teacherProfileData,$teacherProfileData['lesson_id'],$teacherProfileData['class_id']);
        //Sınıflar ve dersler kaydediliyor.
        foreach($teacherProfileData['lesson_id'] as $lesson){ 
            foreach($teacherProfileData['class_id'] as $class){
                $lessonToClassData=[$lesson,$class];
                $lessonToClass=$this->teacherToLessonAndClassService->updateOrCreate($lessonToClassData,$id);
            }
        }
        //öğretmenin seçtiği lokasyonlar kaydediliyor.
        foreach($teacherProfileData['location_id'] as $location){
            $teacherLocation=$this->teacherToLocationService->updateOrCreate($location,$id);
        }
        $teachersDetail=$this->teacherDetailService->update($teacherProfileData,$id);
    }

    public function updateTeacherLessonClassLocation(array $teacherProfileData,int $id=1){
        //dd($teacherProfileData['class_id']);
        //Sınıflar ve dersler kaydediliyor.
        $deleteTeacherLocation=$this->teacherToLessonAndClassService->deleteAll($id);
        $lessonPriceVisible=$this->teacherToLessonPriceService->updateVisible(['visible'=>0],$id);
       
        foreach($teacherProfileData['item_ids'] as $lesson){ 
            $lessonPriceCreate=$this->teacherToLessonPriceService->updateOrCreate(['lesson_id'=>$lesson],$id);
            foreach($teacherProfileData['class_id'] as $class){

            //dd($lesson);
                $lessonToClassData=[$lesson,$class];
                $lessonToClass=$this->teacherToLessonAndClassService->updateOrCreate($lessonToClassData,$id);
            }
        }
        //öğretmenin seçtiği lokasyonlar kaydediliyor.->
        $deleteTeacherLocation=$this->teacherToLocationService->deleteAll($id);
        
        if(!empty($deleteTeacherLocation)){
            foreach($teacherProfileData['location_id'] as $location){
                $teacherLocation=$this->teacherToLocationService->create(['location_id'=>$location,'user_id'=>$id]);
              
            }   
        }
        return [$lessonToClass,$teacherLocation];
    }
    public function updateTeacherProfile(array $teacherProfileData,int $id=1){

    //dd($teacherProfileData);
        $this->teacherProfileService->update($teacherProfileData,$id);

        foreach($teacherProfileData['lesson_id'] as $lesson){
            dd($teacherProfileData);
            $teacherSkilData= [$lesson,$teacherProfileData['lesson_minute'],$teacherProfileData['lesson_face_price'],$teacherProfileData['lesson_online_price']];
            //dd($teacherSkilData);
            $teacherSkil=$this->teacherSkilService->updateOrCreate($teacherSkilData,$id);
    
            
        }
        

    }

    
    }