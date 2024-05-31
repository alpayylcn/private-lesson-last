<?php

namespace App\Models;

use App\Models\Backend\Classes;
use App\Models\Backend\Lesson;
use App\Models\Backend\StepOptionTitle;
use App\Models\Backend\StepQuestion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentPrivateLessonSearch extends Model
{
    use HasFactory,SoftDeletes;
    public $timestamps = true;
    protected $table = 'student_private_lesson_searches';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'student_ip',
        'session_id',
        'step_question_id',
        'step_option_id',
        'statu_type',        
        'student_id',        
        'student_city_id',        
        'student_country_town_id',        
        'page_number',        
        'finish_type' 
    ];
    public function stepOptionTitle() :HasOne
    {
        return $this->hasOne(StepOptionTitle::class,'id','step_option_id');
    } 
    public function stepQuestionTitle() :HasOne
    {
        return $this->hasOne(StepQuestion::class,'id','step_question_id');
    } 
    public function stepClassTitle() :HasOne
    {
        return $this->hasOne(Classes::class,'id','step_option_id');
    } 
    public function stepLessonTitle() :HasOne
    {
        return $this->hasOne(Lesson::class,'id','step_option_id');
    } 
}
