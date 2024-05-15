<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\Classes\ClassController;
use App\Http\Controllers\Backend\CurrencyController;
use App\Http\Controllers\Backend\AddRelationshipLessonAndClassController;
use App\Http\Controllers\Backend\FilterStudentSearchTeacherController;
use App\Http\Controllers\Backend\FilterLessonLocationController;
use App\Http\Controllers\Backend\FilterLessonStartTimeController;
use App\Http\Controllers\Backend\FilterLessonTimePeriodController;
use App\Http\Controllers\Backend\FilterTypeController;
use App\Http\Controllers\Backend\FilterWeekTimeController;
use App\Http\Controllers\Backend\FilterWhoController;
use App\Http\Controllers\Backend\InvoiceAddressController;
use App\Http\Controllers\Backend\Lessons\LessonController;
use App\Http\Controllers\Backend\LessonToClassController;
use App\Http\Controllers\Backend\MonthlyAccountStatementController;
use App\Http\Controllers\Backend\OfferController;
use App\Http\Controllers\Backend\OfferPriceController;
use App\Http\Controllers\Backend\StudentFilterController;
use App\Http\Controllers\Backend\Teacher\TeacherDetailsController;
use App\Http\Controllers\Backend\Teacher\TeacherSkilController;
use App\Http\Controllers\Backend\Teacher\TeacherToLessonPriceController;
use App\Http\Controllers\Backend\UnregisteredStudentController;
use App\Http\Controllers\Backend\WalletAddedMoneyController;
use App\Http\Controllers\Backend\WalletController;
use App\Http\Controllers\Backend\WalletSpentMoneyController;
use App\Http\Controllers\Backend\WalletTransactionController;
use App\Http\Controllers\Backend\WalletTransactionTypeController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\UserDetailController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('master');
})->middleware(['auth', 'verified'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::resources([
    'classes' =>ClassController::class,
    'currencies' =>CurrencyController::class,
    'filter_lesson_locations' =>FilterLessonLocationController::class, 
    'filter_lesson_start_times' =>FilterLessonStartTimeController::class,
    'filter_lesson_time_periods' =>FilterLessonTimePeriodController::class,
    'filter_types'=>FilterTypeController::class,
    'filter_week_times' =>FilterWeekTimeController::class,
    'filter_whos' =>FilterWhoController::class,
    'invoice_addresses'=>InvoiceAddressController::class,
    'lessons' => LessonController::class,
    'lesson_to_classes' => LessonToClassController::class,
    'monthly_account_statements' => MonthlyAccountStatementController::class,
    'offers'=>OfferController::class,
    'offer_prices'=>OfferPriceController::class,
    'student_filters'=>StudentFilterController::class,
    'unregistered_students'=>UnregisteredStudentController::class,
    'wallet_added_money'=>WalletAddedMoneyController::class,
    'wallet_spent_money'=>WalletSpentMoneyController::class,
    'wallets'=>WalletController::class,
    'wallet_transactions'=>WalletTransactionController::class,
    'wallet_transaction_types'=>WalletTransactionTypeController::class
    
    
]);
Route::middleware('auth')->group(function () {

Route::post('all_step_filter_create',[FilterStudentSearchTeacherController::class,'stepCreate'])->name('all_step_filter.stepCreate');
Route::post('all_step_filter_update',[FilterStudentSearchTeacherController::class,'stepUpdate'])->name('all_step_filter.stepUpdate');
Route::resource('all_step_filter',FilterStudentSearchTeacherController::class,['names' => ['index'=>'all_step_filter']]);

//User Detail Route Start
Route::get('users_profile',[UserDetailController::class,'UserEditProfile'])->name('users_profile.index');
Route::post('users_detail_update',[UserDetailController::class,'UserDetailUpdate'])->name('users_detail.update');
//User Detail Route End


//Teacher Route Section Start

Route::get('teachers_profile_lessons',[TeacherDetailsController::class,'lessons'])->name('teachers_profile.lessons');

Route::get('teachers_profile_info',[TeacherDetailsController::class,'info'])->name('teachers_profile.info');
Route::get('teachers_profile_front',[TeacherDetailsController::class,'front'])->name('teachers_profile.front');

Route::post('teachers_profile_update',[TeacherDetailsController::class,'update'])->name('teachers_profile.update');

Route::post('teachers_profile_update_profile',[TeacherDetailsController::class,'updateProfile'])->name('teachers_profile.updateProfile');

Route::get('teachers_profile/delete_classes/{id}',[TeacherDetailsController::class,'deleteClasses'])->name('teachers_profile.deleteClasses');

Route::get('teachers_profile/delete_locations/{id}',[TeacherDetailsController::class,'deleteLocations'])->name('teachers_profile.deleteLocations');
//Teacher Route Section End

//Teacher Lesson Info Route Start

Route::post('teacher_lesson_to_class',[TeacherSkilController::class,'lessonToClassesAjax'])->name('teacher_lesson_to_class.lessonToClassesAjax');

//Teacher Lesson Info Route End

//Teacher Lesson To Price Route Start
Route::get('teachers_profile_lesson_price',[TeacherToLessonPriceController::class,'lessonPrice'])->name('teachers_profile.lessonPrice');
Route::post('teacher_to_lesson_price_update',[TeacherToLessonPriceController::class,'lessonToPriceUpdate'])->name('teacher_to_lesson_price.lessonToPriceUpdate');
//Teacher Lesson To Price Route End

//Lessons Route Section Start
Route::get('add_lessons_list',[LessonController::class,'addLessonList'])->name('lessons.addLessonList');
Route::post('add_lessons_store',[LessonController::class,'store'])->name('lessons.addLessonStore');
Route::post('delete_lessons',[LessonController::class,'deleteLessons'])->name('lessons.deleteLessons');
Route::post('restore_lessons',[LessonController::class,'restoreLessons'])->name('lessons.restoreLessons');
Route::post('force_delete_lessons',[LessonController::class,'forceDeleteLessons'])->name('lessons.forceDeleteLessons');
Route::post('teachers_profile_update_lessons',[TeacherDetailsController::class,'updateLessonClassLocation'])->name('teachers_profile.updateLessonClassLocation');
//Lessons Route Section End

//Classes Route Section Start
Route::get('add_classes',[ClassController::class,'addClassList'])->name('classes.addClassList');
Route::post('add_classes_store',[ClassController::class,'store'])->name('classes.addClassesStore');
Route::post('delete_classes',[ClassController::class,'deleteClasses'])->name('classes.deleteClasses');
Route::post('restore_classes',[ClassController::class,'restoreClasses'])->name('classes.restoreClasses');
Route::post('force_delete_classes',[ClassController::class,'forceDeleteClasses'])->name('classes.forceDeleteClasses');
//Classes Route Section End

//Admin add Lesson_and_Classes Section Start
Route::get('add_relation_lessons_to_classes',[AddRelationshipLessonAndClassController::class,'lessonsToClasses'])->name('relation.LessonsToClasses');
Route::post('add_relation_lessons_to_classes_update',[AddRelationshipLessonAndClassController::class,'updateOrCreate'])->name('relation.LessonsToClassesUpdate');
Route::post('admin_lesson_to_class',[AddRelationshipLessonAndClassController::class,'adminLessonToClassesAjax'])->name('admin_lesson_to_class.adminLessonToClassesAjax');
//Admin add Lesson_and_Classes Section End

//Admin Route Section Start
Route::get('admin_dashboard',[AdminController::class,'index'])->name('admin_dashboard.index');
//Admin Route Section End

//Admin Filter Section Start
Route::get('admin_filter_items',[AdminController::class,'filterItems'])->name('admin.filterItems');
Route::post('admin_filter_items_add',[AdminController::class,'filterItemsAdd'])->name('admin.filterItemsAdd');
Route::post('admin_filter_items_update',[AdminController::class,'filterItemsUpdate'])->name('admin.filterItemsUpdate');
Route::post('admin_filter_items_delete',[AdminController::class,'filterItemsDelete'])->name('admin.filterItemsDelete');
Route::get('admin_filter_lesson_location_edit',[FilterLessonLocationController::class,'filterLessonLocationEdit'])->name('admin.filterLessonLocationEdit');
Route::post('admin_filter_lesson_location_update',[FilterLessonLocationController::class,'filterLessonLocationUpdate'])->name('admin.filterLessonLocationUpdate');
Route::post('admin_filter_lesson_location_add',[FilterLessonLocationController::class,'filterLessonLocationAdd'])->name('admin.filterLessonLocationAdd');
Route::get('admin_filter_lesson_who_edit',[FilterWhoController::class,'filterLessonWhoEdit'])->name('admin.filterLessonWhoEdit');
Route::get('admin_filter_lesson_week_time_edit',[FilterWeekTimeController::class,'filterLessonWeekTimeEdit'])->name('admin.filterLessonWeekTimeEdit');
Route::get('admin_filter_lesson_time_period_edit',[FilterLessonTimePeriodController::class,'filterLessonTimePeriodEdit'])->name('admin.filterLessonTimePeriodEdit');
Route::get('admin_filter_lesson_start_time_edit',[FilterLessonStartTimeController::class,'filterLessonStartTimeEdit'])->name('admin.filterLessonStartTimeEdit');
Route::get('admin_filter_lesson_type_edit',[FilterTypeController::class,'filterLessonTypeEdit'])->name('admin.filterLessonTypeEdit');
//Admin Filter Section End



//City County js Home
Route::post('api/fetch-county',[UserDetailController::class,'fetchCounty'])->name('fetch.county');
//City County js End



});
