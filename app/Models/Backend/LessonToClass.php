<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonToClass extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'lesson_to_classes';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'lesson_id',
        'class_id'];

       
        public function lesson() :BelongsTo
        {
            return $this->belongsTo(Lesson::class,'lesson_id','id')->withTrashed();
        } 
        public function classes() :HasOne
        {
            return $this->hasOne(Classes::class,'id','class_id');
        } 

        public function lessonMany() :HasMany
        {
            return $this->hasMany(Lesson::class,'id','lesson_id');
        } 
        public function classesMany() :HasMany
        {
            return $this->hasMany(Classes::class,'id','class_id');
        } 
        
}

