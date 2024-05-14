<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FilterAllStep extends Model
{
    use HasFactory; 
    public $timestamps = true; 
    protected $table = 'filter_all_steps';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'step',
        'step_question_id'        
    ];
    public function stepQuestion() :HasOne
    {
        return $this->hasOne(StepQuestion::class,'id','step_question_id');
    } 
}
