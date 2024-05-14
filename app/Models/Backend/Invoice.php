<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'invoices';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $fillable = [
        'user_id',
        'invoice_address_id'];

        public function user() :HasOne
        {
            return $this->hasOne(User::class,'id','user_id');
        } 

        public function invoice_address() :HasOne
        {
            return $this->hasOne(InvoiceAddress::class,'id','invoice_address_id');
        }
}
