<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlyAccountStatement extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'monthly_account_statements';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'user_id',
        'total_spent_money',
        'total_added_money',
        'daily',
        'mounth',
        'year',
    ];

    public function user() :HasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    } 
}
