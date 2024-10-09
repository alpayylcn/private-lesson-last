<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class FilterLessonLocation extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'filter_lesson_locations';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'title',
        'teacher_title',
        'add_user_id'];

        public function add_user() :HasOne
        {
            return $this->hasOne(User::class,'id','add_user_id');
        } 
}
