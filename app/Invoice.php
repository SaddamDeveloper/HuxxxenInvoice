<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'client', 'client_address', 'invoice_no', 'invoice_date', 'contact_no', 'discount', 'sub_total', 'grand_total'
    ];

    public function products(){
        return $this->hasMany(InvoiceProduct::class);
    }
}
