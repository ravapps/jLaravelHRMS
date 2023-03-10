<?php

namespace App\Exports;

use App\EmpRoasterShifts;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class RoasterExport implements FromView
{

  protected $fillable = [
      'fromdate',
      'todate',
      'employee',
    ];


    public function view(): View
    {


            $fromdate = $this->fromdate;
            $todate =  $this->todate;
            if($this->employee == "all") {
              $empname = "All employess in given date range";
            } else {
              $e = \App\Employee::where('id',$this->employee)->first();
            //  var_dump($e);
            //  echo $this->employee;
              $empname = $e->name;
            }

      $rawqry = "SELECT a.name as empname,a.designation_id as desid,a.worker_id,c.id as shiftid, b.id as roasterid, c.*,b.* ";
      $rawqry = $rawqry." from   employees a,emp_roaster_shifts b,shift_types c where ";
      $rawqry = $rawqry." ( a.id = b.employee_id ";
      $rawqry = $rawqry." AND b.shift_type = c.id ) AND ";
      $rawqry = $rawqry." ( ('".$fromdate."' BETWEEN b.from_date and b.to_date) OR ('".$todate."' BETWEEN b.from_date and b.to_date) OR (b.from_date BETWEEN '".$fromdate."' and '".$todate."') OR (b.to_date BETWEEN '".$fromdate."' and '".$todate."') ) ";
      if($this->employee <> "all") {
        $rawqry = $rawqry." AND (b.employee_id =  ".$this->employee.") ";
      }
      $get_data= DB::select(DB::raw($rawqry ));


        return view('roaster.export',compact('fromdate','todate','empname','get_data'));
    }
}
