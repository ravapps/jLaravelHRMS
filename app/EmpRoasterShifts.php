<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpRoasterShifts extends Model
{
    // table name : emp_roaster_shifts



    public function employee()
    {
        return $this->belongsTo('App\Employee',"employee_id","id")->select('id','name');
    }

    public function shift_name()
    {
        return $this->belongsTo('App\ShiftTypes',"shift_type","id")->select('id','name');
    }

}
