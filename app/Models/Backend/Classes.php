<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Classes extends Model
{
    use HasFactory,SoftDeletes;
    public $timestamps = true;
    protected $table = 'classes';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'title',
        'add_user_id'];

        public function add_user() :HasOne
        {
            return $this->hasOne(User::class,'id','add_user_id');
        }
        public function teacher_to_classes():HasMany{
            return $this->hasMany(TeacherToLessonAndClass::class,'class_id','id');
        }     
        public function hasClass()//x sınıfı TeacherToLessonAndClass tablosunda var mı?
        {
            return $this->teacher_to_classes()->exists();
        }   
}
