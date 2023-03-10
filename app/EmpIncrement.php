<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpIncrement extends Model
{
    protected $fillable = [
        'employee_id',
        'department_id',
        'designation_id',
        'joining_date',
        'previous_salary',
        'salary_type',
        'increment_date',
       'increment_percent',
       'grade_id',
        'created_by',
    ];
}
