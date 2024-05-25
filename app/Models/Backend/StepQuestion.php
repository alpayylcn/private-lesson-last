<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StepQuestion extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'step_questions';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'title',
        'rank'
    ];

    public function stepOption() :Hasmany
    {
        return $this->hasMany(StepOption::class,'id','question_id');
    } 

    public function stepOptionTitle() :Hasmany
    {
        return $this->hasMany(StepOptionTitle::class,'question_id','id');
    }
}
