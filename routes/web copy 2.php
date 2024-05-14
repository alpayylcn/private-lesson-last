<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Backend\ClassController;
use App\Http\Controllers\Backend\CurrencyController;
use App\Http\Controllers\Backend\FilterStudentSearchTeacherController;
use App\Http\Controllers\Backend\FilterLessonLocationController;
use App\Http\Controllers\Backend\FilterLessonStartTimeController;
use App\Http\Controllers\Backend\FilterLessonTimePeriodController;
use App\Http\Controllers\Backend\FilterTypeController;
use App\Http\Controllers\Backend\FilterWeekTimeController;
use App\Http\Controllers\Backend\FilterWhoController;
use App\Http\Controllers\Backend\InvoiceAddressController;
use App\Http\Controllers\Backend\LessonController;
use App\Http\Controllers\Backend\LessonToClassController;
use App\Http\Controllers\Backend\MonthlyAccountStatementController;
use App\Http\Controllers\Backend\OfferController;
use App\Http\Controllers\Backend\OfferPriceController;
use App\Http\Controllers\Backend\StudentFilterController;
use App\Http\Controllers\Backend\TeacherDetailsController;
use App\Http\Controllers\Backend\UnregisteredStudentController;
use App\Http\Controllers\Backend\WalletAddedMoneyController;
use App\Http\Controllers\Backend\WalletController;
use App\Http\Controllers\Backend\WalletSpentMoneyController;
use App\Http\Controllers\Backend\WalletTransactionController;
use App\Http\Controllers\Backend\WalletTransactionTypeController;
use App\Models\Backend\FilterLessonStartTime;
use App\Models\Backend\FilterLessonTimePeriod;
use App\Models\Backend\FilterWeekTime;
use App\Models\Backend\FilterWho;
use App\Models\Backend\MonthlyAccountStatement;
use App\Models\Backend\UnregisteredStudent;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



Route::get('/', function () {
    return view('master');
});

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
Route::post('all_step_filter_create',[FilterStudentSearchTeacherController::class,'stepCreate'])->name('all_step_filter.stepCreate');
Route::post('all_step_filter_update',[FilterStudentSearchTeacherController::class,'stepUpdate'])->name('all_step_filter.stepUpdate');
Route::resource('all_step_filter',FilterStudentSearchTeacherController::class,['names' => ['index'=>'all_step_filter']]);

Route::get('teachers_profile',[TeacherDetailsController::class,'index'])->name('teachers_profile.index');
Route::get('teachers_profile_lessons',[TeacherDetailsController::class,'lessons'])->name('teachers_profile.lessons');
Route::get('teachers_profile_info',[TeacherDetailsController::class,'info'])->name('teachers_profile.info');
Route::get('teachers_profile_front',[TeacherDetailsController::class,'front'])->name('teachers_profile.front');

Route::post('teachers_profile_update',[TeacherDetailsController::class,'update'])->name('teachers_profile.update');
Route::post('teachers_profile_update_lessons',[TeacherDetailsController::class,'updateLessons'])->name('teachers_profile.updateLessons');
Route::post('teachers_profile_update_profile',[TeacherDetailsController::class,'updateProfile'])->name('teachers_profile.updateProfile');

Route::get('teachers_profile/delete_classes/{id}',[TeacherDetailsController::class,'deleteClasses'])->name('teachers_profile.deleteClasses');
Route::get('teachers_profile/delete_lessons/{id}',[TeacherDetailsController::class,'deleteLessons'])->name('teachers_profile.deleteLessons');
Route::get('teachers_profile/delete_locations/{id}',[TeacherDetailsController::class,'deleteLocations'])->name('teachers_profile.deleteLocations');