<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeManageLeave extends Model
{
    protected $table='employee_manage_leave';
    protected $fillable = [
        'leave_type_id',
        'employee_id',
        'total_leaves',
        'created_by',
    ];
}
