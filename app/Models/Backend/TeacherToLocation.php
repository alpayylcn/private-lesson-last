<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherToLocation extends Model

{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'teacher_to_locations';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'user_id',
        'location_id',     
                
              
                  
             
    ];
    public function user() :HasOne
    {
        return $this->hasOne(Lesson::class,'id','user_id');
    } 
    public function location() :HasOne
    {
        return $this->hasOne(FilterLessonLocation::class,'id','location_id');
    } 

   
}
