<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    protected $fillable = [
        'name', 'qty', 'price', 'total'
    ];

    public function invoice(){
        return $this->hasMany(Invoice::class);
    }
}
