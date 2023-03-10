<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimsItems extends Model
{
    //


    protected $fillable = [
        'claim_id',
        'title',
        'qty',
        'price',
        'tax',
        'remark',
        'documents',
        'created_by',
    ];
}
