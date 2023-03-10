<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShiftTypes extends Model
{
    // table name : shift_types

    public function shift_type()
    {
        return $this->hasMany('App\EmpRoasterShifts');
    }

}
