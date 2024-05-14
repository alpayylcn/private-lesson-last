<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentFilter extends Model
{
    use HasFactory,SoftDeletes;
    public $timestamps = true;
    protected $table = 'student_filters';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'student_ip',
        'lesson_id',     
        'class_id',        
        'filter_lesson_location_id',        
        'filter_who_id',        
        'filter_week_time_id',        
        'filter_lesson_time_period_id',        
        'filter_lesson_start_time_id',        
        'filter_type_id',        
        'statu_type',        
        'student_id',        
        'student_city_id',        
        'student_country_town_id',        
        'page_number',        
        'finish_type'        
    ];

    public function lesson() :HasOne
    {
        return $this->hasOne(Lesson::class,'id','lesson_id');
    } 

    public function classes() :HasOne
    {
        return $this->hasOne(Classes::class,'id','class_id');
    } 
    public function filter_lesson_location() :HasOne
    {
        return $this->hasOne(FilterLessonLocation::class,'id','filter_lesson_location_id');
    } 
    public function filter_who() :HasOne
    {
        return $this->hasOne(FilterWho::class,'id','filter_who_id');
    } 
    public function filter_week_time() :HasOne
    {
        return $this->hasOne(FilterWeekTime::class,'id','filter_week_time_id');
    } 
    public function filter_lesson_time_period() :HasOne
    {
        return $this->hasOne(FilterLessonTimePeriod::class,'id','filter_lesson_time_period_id');
    } 
    public function filter_lesson_start_time() :HasOne
    {
        return $this->hasOne(FilterLessonStartTime::class,'id','filter_lesson_start_time_id');
    } 
    public function filter_type() :HasOne
    {
        return $this->hasOne(FilterType::class,'id','filter_type_id');
    } 
    public function student() :HasOne
    {
        return $this->hasOne(User::class,'id','student_id');
    } 
    

}
