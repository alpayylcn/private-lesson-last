<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherDetail extends Model
{
    use HasFactory,SoftDeletes;
    public $timestamps = true;
    protected $table = 'teacher_details';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'user_id',
        'name',
        'surname',     
        'mail',        
        'phone',        
        'gender',        
        'city',        
        'county',        
        'district',        
        'photo'        
                  
             
    ];


    

    public function user() :HasOne
    {
        return $this->hasOne(Lesson::class,'id','user_id');
    } 
    public function lesson() :HasOne
    {
        return $this->hasOne(Lesson::class,'id','teacher_lesson_id');
    } 

    public function classes() :HasOne
    {
        return $this->hasOne(Classes::class,'id','teacher_class_id');
    } 
    public function filter_lesson_location() :HasOne
    {
        return $this->hasOne(FilterLessonLocation::class,'id','teacher_lesson_location_id');
    } 
   
   
}
