<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpGradeAllowance extends Model
{
    protected $fillable = [
        'grade_id',
        'allowance_id',
        'created_at',
       
    ];
}
