<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'offers';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'filter_id',
        'teacher_id'        
    ];

    public function student_filter() :HasOne
    {
        return $this->hasOne(StudentFilter::class,'id','filter_id');
    } 
    public function teacher() :HasOne
    {
        return $this->hasOne(User::class,'id','teacher_id');
    }
}
