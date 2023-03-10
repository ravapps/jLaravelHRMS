<?php

namespace App\Http\Controllers;
use App\Imports\EmployeesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\AttendanceEmployee;
use App\Branch;
use App\Department;
use App\Employee;
use App\EmpRoasterShifts;
use App\ShiftTypes;
use App\User;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceEmployeeController extends Controller
{
    public function index(Request $request)
    {
        if(\Auth::user()->can('Manage Attendance'))
        {
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $branch->prepend('All', '');

            $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $department->prepend('All', '');

            if(\Auth::user()->type == 'employee')
            {

                $emp = !empty(\Auth::user()->employee) ? \Auth::user()->employee->id : 0;

                $attendanceEmployee = AttendanceEmployee::where('employee_id', $emp);

                if($request->type == 'monthly' && !empty($request->month))
                {
                    $month = date('m', strtotime($request->month));
                    $year  = date('Y', strtotime($request->month));

                    $start_date = date($year . '-' . $month . '-01');
                    $end_date   = date($year . '-' . $month . '-t');

                    $attendanceEmployee->whereBetween(
                        'date', [
                                  $start_date,
                                  $end_date,
                              ]
                    );
                }
                elseif($request->type == 'daily' && !empty($request->date))
                {
                    $attendanceEmployee->where('date', $request->date);
                }
                else
                {
                    $month      = date('m');
                    $year       = date('Y');
                    $start_date = date($year . '-' . $month . '-01');
                    $end_date   = date($year . '-' . $month . '-t');

                    $attendanceEmployee->whereBetween(
                        'date', [
                                  $start_date,
                                  $end_date,
                              ]
                    );
                }
                $attendanceEmployee = $attendanceEmployee->get();

            }
            else
            {
                $employee = Employee::select('id')->where('created_by', \Auth::user()->creatorId());
                if(!empty($request->branch))
                {
                    $employee->where('branch_id', $request->branch);
                }

                if(!empty($request->department))
                {
                    $employee->where('department_id', $request->department);
                }

                $employee = $employee->get()->pluck('id');

                $attendanceEmployee = AttendanceEmployee::whereIn('employee_id', $employee);
                
                if($request->type == 'monthly' && !empty($request->month))
                {
                    $month = date('m', strtotime($request->month));
                    $year  = date('Y', strtotime($request->month));

                    $start_date = date($year . '-' . $month . '-01');
                    $end_date   = date($year . '-' . $month . '-t');

                    $attendanceEmployee->whereBetween(
                        'date', [
                                  $start_date,
                                  $end_date,
                              ]
                    );
                }
                elseif($request->type == 'daily' && !empty($request->date))
                {
                    $attendanceEmployee->where('date', $request->date);
                }
                else
                {
                    $month      = date('m');
                    $year       = date('Y');
                    $start_date = date($year . '-' . $month . '-01');
                    $end_date   = date($year . '-' . $month . '-t');

                    $attendanceEmployee->whereBetween(
                        'date', [
                                  $start_date,
                                  $end_date,
                              ]
                    );
                }


                $attendanceEmployee = $attendanceEmployee->get();

            }

            return view('attendance.index', compact('attendanceEmployee', 'branch', 'department'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('Create Attendance'))
        {
            $employees = Employee::where('created_by', '=', Auth::user()->creatorId())->get();

            return view('attendance.create', compact('employees'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }


    }

    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Attendance'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'employee_id' => 'required',
                                   'date' => 'required',
                                   'clock_in' => 'required',
                                   'clock_out' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $get_shift_name=EmpRoasterShifts::where("employee_id",$request->employee_id)->orderBy("id","DESC")->first();
            $get_start_time= $get_end_time='';
            if(!empty($get_shift_name))
            {
                $get_shift_details=ShiftTypes::where("id",$get_shift_name->shift_type)->first();
                $get_start_time=$get_shift_details->start_time;
                $get_end_time=$get_shift_details->end_time;
            }
            else
            {
                return redirect()->route('attendanceemployee.index')->with('error', __('Please  Add Shift First.'));
            }
             

            $startTime  = $get_start_time;//Utility::getValByName('company_start_time');
            $endTime    = $get_end_time;//Utility::getValByName('company_end_time');
            $attendance = AttendanceEmployee::where('employee_id', '=', $request->employee_id)->where('date', '=', $request->date)->where('clock_out', '=', '00:00:00')->get()->toArray();
            if($attendance)
            {
                return redirect()->route('attendanceemployee.index')->with('error', __('Employee Attendance Already Created.'));
            }
            else
            {
                $date = date("Y-m-d");

                $totalLateSeconds = strtotime($request->clock_in) - strtotime($date . $startTime);

                $hours = floor($totalLateSeconds / 3600);
                $mins  = floor($totalLateSeconds / 60 % 60);
                $secs  = floor($totalLateSeconds % 60);
                $late  = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

                //early Leaving
                $totalEarlyLeavingSeconds = strtotime($date . $endTime) - strtotime($request->clock_out);
                $hours                    = floor($totalEarlyLeavingSeconds / 3600);
                $mins                     = floor($totalEarlyLeavingSeconds / 60 % 60);
                $secs                     = floor($totalEarlyLeavingSeconds % 60);
                $earlyLeaving             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);


                $get_employee_grade=Employee::join('emp_paygrades', 'employees.pay_grade', '=', 'emp_paygrades.id')->where("employees.id",$request->employee_id)->first();
                if($get_employee_grade->grade_type=='Monthly')
                {
                    $total_hrs=strtotime($request->clock_out) - strtotime($request->clock_in);
                    $total_hrs=floor($total_hrs/3600)-1;
                    if($total_hrs>8) $total_hrs=8;

                }
                else
                {
                    $total_hrs=strtotime($request->clock_out) - strtotime($request->clock_in);
                    $total_hrs=floor($total_hrs/3600);
                    if($total_hrs>9) $total_hrs=9;

                }
                if(strtotime($request->clock_out) > strtotime($date . $endTime))
                {
                    //Overtime
                    $totalOvertimeSeconds = strtotime($request->clock_out) - strtotime($date . $endTime);
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
                $employeeAttendance->employee_id   = $request->employee_id;
                $employeeAttendance->date          = $request->date;
                $employeeAttendance->status        = 'Present';
                $employeeAttendance->clock_in      = $request->clock_in . ':00';
                $employeeAttendance->clock_out     = $request->clock_out . ':00';
                $employeeAttendance->total_hrs     = $total_hrs;
                $employeeAttendance->shift_id          =  $request->shift_id;
                $employeeAttendance->late          = $late;
                $employeeAttendance->early_leaving = $earlyLeaving;
                $employeeAttendance->overtime      = $overtime;
                $employeeAttendance->total_rest    = '00:00:00';
                $employeeAttendance->created_by    = \Auth::user()->creatorId();
                $employeeAttendance->save();

                return redirect()->route('attendanceemployee.index')->with('success', __('Employee attendance successfully created.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function edit($id)
    {
        if(\Auth::user()->can('Edit Attendance'))
        {
            $attendanceEmployee = AttendanceEmployee::where('id', $id)->first();
            $employees          = Employee::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('attendance.edit', compact('attendanceEmployee', 'employees'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function update(Request $request, $id)
    {
        $employeeId      = !empty(\Auth::user()->employee) ? \Auth::user()->employee->id : 0;
        $todayAttendance = AttendanceEmployee::where('employee_id', '=', $employeeId)->where('date', date('Y-m-d'))->first();
        if(!empty($todayAttendance) && $todayAttendance->clock_out == '00:00:00')
        {
            $total_hrs=strtotime($request->clock_out) - strtotime($request->clock_in);
            $total_hrs=floor($total_hrs/3600);
            $startTime = Utility::getValByName('company_start_time');
            $endTime   = Utility::getValByName('company_end_time');
            if(Auth::user()->type == 'employee')
            {

                $date = date("Y-m-d");
                $time = date("H:i:s");
              
                //early Leaving
                $totalEarlyLeavingSeconds = strtotime($date . $endTime) - time();
                $hours                    = floor($totalEarlyLeavingSeconds / 3600);
                $mins                     = floor($totalEarlyLeavingSeconds / 60 % 60);
                $secs                     = floor($totalEarlyLeavingSeconds % 60);
                $earlyLeaving             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

                if(time() > strtotime($date . $endTime))
                {
                    //Overtime
                    $totalOvertimeSeconds = time() - strtotime($date . $endTime);
                    $hours                = floor($totalOvertimeSeconds / 3600);
                    $mins                 = floor($totalOvertimeSeconds / 60 % 60);
                    $secs                 = floor($totalOvertimeSeconds % 60);
                    $overtime             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
                }
                else
                {
                    $overtime = '00:00:00';
                }

                $attendanceEmployee                = AttendanceEmployee::find($id);
                $attendanceEmployee->clock_out     = $time;
                $attendanceEmployee->early_leaving = $earlyLeaving;
                $attendanceEmployee->overtime      = $overtime;
                $attendanceEmployee->save();

                return redirect()->route('home')->with('success', __('Employee successfully clock Out.'));
            }
            else
            {
                $date = date("Y-m-d");
                //late
                $totalLateSeconds = strtotime($request->clock_in) - strtotime($date . $startTime);

                $hours = floor($totalLateSeconds / 3600);
                $mins  = floor($totalLateSeconds / 60 % 60);
                $secs  = floor($totalLateSeconds % 60);
                $late  = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

                //early Leaving
                $totalEarlyLeavingSeconds = strtotime($date . $endTime) - strtotime($request->clock_out);
                $hours                    = floor($totalEarlyLeavingSeconds / 3600);
                $mins                     = floor($totalEarlyLeavingSeconds / 60 % 60);
                $secs                     = floor($totalEarlyLeavingSeconds % 60);
                $earlyLeaving             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);


                if(strtotime($request->clock_out) > strtotime($date . $endTime))
                {
                    //Overtime
                    $totalOvertimeSeconds = strtotime($request->clock_out) - strtotime($date . $endTime);
                    $hours                = floor($totalOvertimeSeconds / 3600);
                    $mins                 = floor($totalOvertimeSeconds / 60 % 60);
                    $secs                 = floor($totalOvertimeSeconds % 60);
                    $overtime             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
                }
                else
                {
                    $overtime = '00:00:00';
                }

                $attendanceEmployee                = AttendanceEmployee::find($id);
                $attendanceEmployee->employee_id   = $request->employee_id;
                $attendanceEmployee->date          = $request->date;
                $attendanceEmployee->clock_in      = $request->clock_in;
                $attendanceEmployee->clock_out     = $request->clock_out;
                $employeeAttendance->total_hrs     = $total_hrs;
                $attendanceEmployee->late          = $late;
                $attendanceEmployee->early_leaving = $earlyLeaving;
                $attendanceEmployee->overtime      = $overtime;
                $attendanceEmployee->total_rest    = '00:00:00';

                $attendanceEmployee->save();

                return redirect()->route('attendanceemployee.index')->with('success', __('Employee attendance successfully updated.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Employee are not allow multiple time clock in & clock for every day.'));
        }
    }

    public function destroy($id)
    {
        if(\Auth::user()->can('Delete Attendance'))
        {
            $attendance = AttendanceEmployee::where('id', $id)->first();

            $attendance->delete();

            return redirect()->route('attendanceemployee.index')->with('success', __('Attendance successfully deleted.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function json(Request $request)
    {
       
        $get_shift_name=EmpRoasterShifts::where("employee_id",$request->employee_id_s)->orderBy("id","DESC")->first();
        $get_shift_details=ShiftTypes::where("id",$get_shift_name->shift_type)->first();
        $get_shift_id=$get_name=$get_start_time=$get_end_time='';
       
        $get_shift_id=$get_shift_details->id;
        $get_name=$get_shift_details->name;
        $get_start_time=$get_shift_details->start_time;
        $get_end_time=$get_shift_details->end_time;

        $result=array("get_shift_id"=>$get_shift_id,"get_name"=>$get_name,"get_start_time"=>$get_start_time,"get_end_time"=>$get_end_time);
        return response()->json($result);
    }
    public function attendance(Request $request)
    {
        $employeeId      = !empty(\Auth::user()->employee) ? \Auth::user()->employee->id : 0;
        $todayAttendance = AttendanceEmployee::where('employee_id', '=', $employeeId)->where('date', date('Y-m-d'))->first();
        if(empty($todayAttendance))
        {

            $startTime = Utility::getValByName('company_start_time');
            $endTime   = Utility::getValByName('company_end_time');

            $attendance = AttendanceEmployee::orderBy('id', 'desc')->where('employee_id', '=', $employeeId)->where('clock_out', '=', '00:00:00')->first();

            if($attendance != null)
            {
                $attendance            = AttendanceEmployee::find($attendance->id);
                $attendance->clock_out = $endTime;
                $attendance->save();
            }

            $date = date("Y-m-d");
            $time = date("H:i:s");

            //late
            $totalLateSeconds = time() - strtotime($date . $startTime);
            $hours            = floor($totalLateSeconds / 3600);
            $mins             = floor($totalLateSeconds / 60 % 60);
            $secs             = floor($totalLateSeconds % 60);
            $late             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

            $checkDb = AttendanceEmployee::where('employee_id', '=', \Auth::user()->id)->get()->toArray();


            if(empty($checkDb))
            {
                $employeeAttendance                = new AttendanceEmployee();
                $employeeAttendance->employee_id   = $employeeId;
                $employeeAttendance->date          = $date;
                $employeeAttendance->status        = 'Present';
                $employeeAttendance->clock_in      = $time;
                $employeeAttendance->clock_out     = '00:00:00';
                $employeeAttendance->late          = $late;
                $employeeAttendance->early_leaving = '00:00:00';
                $employeeAttendance->overtime      = '00:00:00';
                $employeeAttendance->total_rest    = '00:00:00';
                $employeeAttendance->created_by    = \Auth::user()->id;

                $employeeAttendance->save();

                return redirect()->route('home')->with('success', __('Employee Successfully Clock In.'));
            }
            foreach($checkDb as $check)
            {


                $employeeAttendance                = new AttendanceEmployee();
                $employeeAttendance->employee_id   = $employeeId;
                $employeeAttendance->date          = $date;
                $employeeAttendance->status        = 'Present';
                $employeeAttendance->clock_in      = $time;
                $employeeAttendance->clock_out     = '00:00:00';
                $employeeAttendance->late          = $late;
                $employeeAttendance->early_leaving = '00:00:00';
                $employeeAttendance->overtime      = '00:00:00';
                $employeeAttendance->total_rest    = '00:00:00';
                $employeeAttendance->created_by    = \Auth::user()->id;

                $employeeAttendance->save();

                return redirect()->route('home')->with('success', __('Employee Successfully Clock In.'));

            }
        }
        else
        {
            return redirect()->back()->with('error', __('Employee are not allow multiple time clock in & clock for every day.'));
        }
    }

    public function bulkAttendance(Request $request)
    {
        if(\Auth::user()->can('Create Attendance'))
        {

            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $branch->prepend('Select Branch', '');

            $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $department->prepend('Select Department', '');

            $employees = [];
            if(!empty($request->branch) && !empty($request->department))
            {
                $employees = Employee::where('created_by', \Auth::user()->creatorId())->where('branch_id', $request->branch)->where('department_id', $request->department)->get();


            }


            return view('attendance.bulk', compact('employees', 'branch', 'department'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function bulkAttendanceData(Request $request)
    {


        $data_excel=Excel::import(new EmployeesImport, $request->file('bulk_upload'));

        
    }

}
