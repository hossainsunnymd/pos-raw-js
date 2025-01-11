<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    protected $fillable=['user_id','invoice_id','product_id','qty','sales_price'];

    function product(){
        return $this->belongsTo(Product::class);
    }
}
