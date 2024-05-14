<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceAddress extends Model
{
    use HasFactory,SoftDeletes;
    public $timestamps = true;
    protected $table = 'invoice_addresses';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'address',
        'zip_code',
        'city',
        'country_town',
        'state',
        'contact_name',
        'phone',
    ];
}
