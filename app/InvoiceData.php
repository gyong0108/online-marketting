<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceData extends Model
{
    protected $fillable = [
        'company',
        'street_no',
        'city',
        'state',
        'country',
        'zip',
        'tax_id',
        'amount',
        'created_at',
        'updated_at',
        'created_by_id'
    ];

    public  $table ='invoice_data';
}
