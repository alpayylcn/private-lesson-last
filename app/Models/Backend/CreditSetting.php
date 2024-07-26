<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditSetting extends Model
{
    use HasFactory;
    protected $fillable = ['duration_id', 'credit_amount'];
    public function duration()
    {
        return $this->belongsTo(Duration::class);
    }
}

