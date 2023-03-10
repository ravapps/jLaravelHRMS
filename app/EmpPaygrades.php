<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpPaygrades extends Model
{
    protected $fillable = [
        'grade_type',
        'grade_name',
        'gross_salary',
        'basic_salary',
        'percentage',
        'overtime',
        'created_by',
       
    ];
}
