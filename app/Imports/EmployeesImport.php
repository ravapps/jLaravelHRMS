<?php

namespace App\Imports;
use App\AttendanceEmployee;
use App\Employee;
use App\User;
use App\Utility;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow ;
class EmployeesImport implements ToCollection, WithHeadingRow 
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $rows)
    {

        if(!empty($rows) && count($rows)>0)
        {
           
            foreach($rows as $val)
            {
                
                    if(!empty($val['email']))
                    {  
                        
                        //$check_employee_exist= Employee::where("email",$val['email'])->first();
                        $check_employee_exist=Employee::join('emp_paygrades', 'employees.pay_grade', '=', 'emp_paygrades.id')->select('employees.*', 'emp_paygrades.grade_type')->where("employees.email",$val['email'])->first();
                       
                        $emp_id='';
                        if(!empty($check_employee_exist))
                            {

                                $get_shift_name=EmpRoasterShifts::where("employee_id",$check_employee_exist->id)->orderBy("id","DESC")->first();
                                $get_start_time= $get_end_time='';
                                if(!empty($get_shift_name))
                                {
                                    $get_shift_details=ShiftTypes::where("id",$get_shift_name->shift_type)->first();
                                    $get_start_time=$get_shift_details->start_time;
                                    $get_end_time=$get_shift_details->end_time;
                                }

                                $startTime  = $get_start_time;
                                $endTime    = $get_end_time;
                               
                                $emp_id=$check_employee_exist->id;
                                $check_attendance_exist= AttendanceEmployee::where('employee_id', $emp_id)->where('date', '=', $val['date'])->first();
                                    if(empty($check_attendance_exist))
                                    {
                                        
                                        $date = date("Y-m-d");
                                        $totalLateSeconds = strtotime($val['clockin']) - strtotime($date . $startTime);

                                        $hours = floor($totalLateSeconds / 3600);
                                        $mins  = floor($totalLateSeconds / 60 % 60);
                                        $secs  = floor($totalLateSeconds % 60);
                                        $late  = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

                                    
                                        $totalEarlyLeavingSeconds = strtotime($date . $endTime) - strtotime($val['clockout']);
                                        $hours                    = floor($totalEarlyLeavingSeconds / 3600);
                                        $mins                     = floor($totalEarlyLeavingSeconds / 60 % 60);
                                        $secs                     = floor($totalEarlyLeavingSeconds % 60);
                                        $earlyLeaving             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
                                       // $get_employee_grade=Employee::join('emp_paygrades', 'employees.pay_grade', '=', 'emp_paygrades.id')->where("employees.id",$request->employee_id)->first();
                                        if($check_employee_exist->grade_type=='Monthly')
                                        {
                                            $total_hrs=strtotime($val['clockout']) - strtotime($val['clockin']);
                                            $total_hrs=floor($total_hrs/3600)-1;
                                            if($total_hrs>8) $total_hrs=8;

                                        }
                                        else
                                        {
                                            $total_hrs=strtotime($val['clockout']) - strtotime($val['clockin']);
                                            $total_hrs=floor($total_hrs/3600);
                                            if($total_hrs>9) $total_hrs=9;

                                        }
                                        if(strtotime($val['clockout']) > strtotime($date . $endTime))
                                        {
                                            //Overtime
                                            $totalOvertimeSeconds = strtotime($val['clockout']) - strtotime($date . $endTime);
                                            $hours                = floor($totalOvertimeSeconds / 3600);
                                            $mins                 = floor($totalOvertimeSeconds / 60 % 60);
                                            $secs                 = floor($totalOvertimeSeconds % 60);
                                            $overtime             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
                                        }
                                        else
                                        {
                                            $overtime = '00:00:00';
                                        }

                                        $employeeAttendance                = new AttendanceEmployee();
                                        $employeeAttendance->employee_id   = $emp_id;
                                        $employeeAttendance->date          = $val['date'];
                                        $employeeAttendance->status        = 'Present';
                                        $employeeAttendance->clock_in      = $val['clockin']. ':00';
                                        $employeeAttendance->clock_out     = $val['clockout']. ':00';
                                        $employeeAttendance->total_hrs     = $total_hrs;
                                        $employeeAttendance->shift_id          =  $val['shiftid'];
                                        $employeeAttendance->late          = $late;
                                        $employeeAttendance->early_leaving = $earlyLeaving;
                                        $employeeAttendance->overtime      = $overtime;
                                        $employeeAttendance->total_rest    = '00:00:00';
                                        $employeeAttendance->created_by    = \Auth::user()->creatorId();
                                        $employeeAttendance->save();
                                    }
                                  
                            }  
                    }        




            }
            return redirect('attendanceemployee/bulkattendance')->with('success', __('Attendance Successfully Added.'));
        }
        else
        {
            return redirect('attendanceemployee/bulkattendance')->with('error', __('File Is Empty'));
        }
       
    }
}
