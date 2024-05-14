<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class FilterWeekTime extends Model
{
    use HasFactory,SoftDeletes;
    public $timestamps = true;
    protected $table = 'filter_week_times';
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
}
