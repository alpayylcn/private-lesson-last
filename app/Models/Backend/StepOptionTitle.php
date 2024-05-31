<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StepOptionTitle extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'step_option_titles';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'question_id',
        'option_id',
        'title',
        'teacher_title',
               
    ];
    public function stepQuestion():BelongsTo
    {
        return $this->belongsTo(StepQuestion::class,'id','question_id');
    }
}
