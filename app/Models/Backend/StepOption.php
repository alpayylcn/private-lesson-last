<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StepOption extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'step_options';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'question_id',
        'option_id',
        'model_type',
        'option_db_field'       
    ];
    public function multiOption(string $model, int $option_id)
    {
      
        return $model::where('id',$option_id)->first();
        
    } 

    public function lesson() :Hasone
    {
        return $this->hasOne(Lesson::class,'id','option_id');
    } 
    
}
